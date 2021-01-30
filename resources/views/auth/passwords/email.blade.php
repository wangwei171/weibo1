@extends('layouts.default')
@section('title','重置密码')

@section('content')
	<div class="offset-md-2 col-md-8">
		<div class="card">
			<div class="card-header">
				<h5>重置密码</h5>
			</div>

			<div class="card-body">
				

				<form action="{{route('password.email')}}" method="POST">
					{{csrf_field()}}

					<div class="form-group{{$errors->has('email')?' has-error':''}}">
						<label class="form-control-label" for="email">邮箱地址</label>
						<input type="email" name="email" class="form-control" id='email' value="{{old('email')}}" required>

						@if($errors->has('email'))
							<span class="form-text">
								<strong>{{$errors->first('email')}}</strong>
							</span>
						@endif
					</div>

					<div class="form-group">
						<button class="btn btn-primary" type="submit">
							发送密码重置邮件
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection