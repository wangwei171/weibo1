@extends('layouts.default')
@section('title','重置密码')

@section('content')
<div class="offset-md-2 col-md-8">
<div class="card">
	<div class="card-header">
		<h5>重置密码</h5>
	</div>

	<div class="card-body">
		<form action="{{route('password.update')}}" method="POST">
			@csrf

			<input type="hidden" name="token" value="{{$token}}">

			<div class="form-group">
				<label for="email">
					邮箱：
				</label>
				<input type="email" name="email" class="form-control" value="{{old('email')}}" required autofocus>
			</div>

			<div class="form-group">
				<label for="password">
					密码：
				</label>
				<input type="password" name="password" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="password-confirm">
					确认密码：
				</label>
				<input type="password" name="password_confirmation" class="form-control" required>
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">重置密码</button>
			</div>
		</form>
	</div>
</div>
</div>
@endsection