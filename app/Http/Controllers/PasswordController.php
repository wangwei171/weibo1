<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Hash;
use Carbon\Carbon;
use DB;
use App\Models\User;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function showLinkRequestForm()
    {
    	return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
    	//1验证邮箱
    	$request->validate(['email' => 'required|email']);
    	$email = $request->email;

    	//2获取对应的用户
    	$user = User::where('email',$email)->first();

    	//3如果没有该用户
    	if(is_null($user))
    	{
    		session()->flash('danger','邮箱未注册！');
    		return redirect()->back()->withInput();
    	}

    	//4用户存在的话生成token
    	$token = hash_hmac('sha256',Str::random(40),config('app.key'));

    	//5入库
    	DB::table('password_resets')->updateOrInsert(['email'=>$email],[
    		'email' => $email,
    		'token' => Hash::make($token),
    		'created_at' => new Carbon
    	]);

    	//6发送邮件
    	Mail::send('emails.reset_link',compact('token'),function ($message) use ($email){
    		$message->to($email)->subject('忘记密码');

    	});

    	session()->flash('success','重置邮件发送成功，请查收！');
    	return redirect()->back();
    }

    public function showResetForm(Request $request)
    {
    	$token = $request->route()->parameter('token');
    	return view('auth.passwords.reset',compact('token'));
    }

    public function reset(Request $request)
    {
    	//1判断表单中的元素
    	$request->validate([
    		'token' => 'required',
    		'email' => 'required|email',
    		'password' =>'required|confirmed|min:6',
    	]);

    	$email = $request->email;
    	$token = $request->token;

    	$expires = 60*10;

    	//2找到用户
    	$user = User::where('email',$email)->first();

    	//3如果邮箱不存在也就是如果用户不存在
    	if(is_null($user)){
    		session()->flash('danger','邮箱未注册！');
    		return redirect()->back()->withInput();
    	}

    	//4用户存在的话先把password_resets表中的记录找出来
    	$records = (array)DB::table('password_resets')->where('email',$email)->first();

    	//5判断，一是看是否超时，二是看token是否一致
    	if($records)
    	{
    		if(Carbon::parse($records['created_at'])->addSeconds($expires)->isPast())
    		{
    			session()->flash('danger','密码重置链接已过期！');
    			return redirect()->back();
    		}

    		//检查令牌是否正确
    		if(!Hash::check($token,$records['token']))
    		{
    			session()->flash('danger','密码重置令牌不正确');
    			return redirect()->back();
    		}

    		//如果令牌正确，链接未超时
    		$user->update(['password' => bcrypt($request->password)]);

    		session()->flash('success','密码重置成功');
    		return redirect()->route('login');
    	}

    	session()->flash('danger','未找到重置记录');
    	return redirect()->back();
    }
}
