@extends('mini')
@section('styles')

	<link href="{{ asset('css/login.min.css') }}" rel="stylesheet">
@endsection
@section('content')
	<div class="container">
		<div class="text-center" style="padding:50px 0">
			<img src="{{ asset('img/logo.png') }}">
			<div class="logo">Crew Development Training System</div>
			<!-- Main Form -->
			<div class="login-form-1">
				<form id="register-form" class="text-left" method="POST" action="/register">
					{!! csrf_field() !!}
					@if (count($errors) > 0)
						<div class="login-form-main-message show error">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<div class="main-login-form">
						<div class="login-group">
							<div class="form-group">
								<label for="reg_username" class="sr-only">Username</label>
								<input type="text" class="form-control" id="reg_username" name="username" placeholder="username" value="{{ old('name') }}">
							</div>
							<div class="form-group">
								<label for="reg_password" class="sr-only">Password</label>
								<input type="password" class="form-control" id="reg_password" name="password" placeholder="password">
							</div>
							<div class="form-group">
								<label for="reg_password_confirm" class="sr-only">Password Confirm</label>
								<input type="password" class="form-control" id="reg_password_confirm" name="password_confirmation" placeholder="confirm password">
							</div>

							<div class="form-group">
								<label for="reg_email" class="sr-only">Email</label>
								<input type="email" class="form-control" id="reg_email" name="email" placeholder="email" value="{{ old('email') }}">
							</div>
							<div class="form-group">
								<label for="reg_contact" class="sr-only">Contact</label>
								<input type="text" class="form-control" id="reg_contact" name="contact" placeholder="contact">
								<small class="help-text">For SMS Notifications</small>
							</div>
							<div class="form-group">
								<label for="reg_fullname" class="sr-only">Full Name</label>
								<input type="text" class="form-control" id="reg_fullname" name="fullname" placeholder="full name">
							</div>

							<div class="form-group login-group-checkbox">
								<input type="radio" class="" name="gender" id="male" value="male">
								<label for="male">male</label>

								<input type="radio" class="" name="gender" id="female" value="female">
								<label for="female">female</label>
							</div>

							<div class="form-group login-group-checkbox">
								<input type="checkbox" class="" id="reg_agree" name="reg_agree">
								<label for="reg_agree">i agree with all the <br><a href="#" style="color:#888;">terms &amp; conditions</a></label>
							</div>
						</div>
						<button type="submit" class="login-button">
							<i>Go</i>
							<i class="fa fa-angle-double-right"></i>
						</button>
					</div>
					<div class="etc-login-form">
						<p>already have an account? <a href="/login">login here</a></p>
					</div>
				</form>
			</div>
			<!-- end:Main Form -->
		</div>
	</div>

@endsection
