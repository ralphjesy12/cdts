@extends('mini')
@section('styles')

<link href="{{ asset('css/login.min.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="container">
	<!-- LOGIN FORM -->
	<div class="text-center" style="padding:50px 0">
		<img src="{{ asset('img/logo.png') }}">
		<div class="logo">Crew Development Training System</div>
		<!-- Main Form -->
		<div class="login-form-1">
			<form id="login-form" class="text-left" method="POST" action="/login">
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
							<label for="lg_username" class="sr-only">Username</label>
							<input type="text" class="form-control" id="lg_username" name="username" placeholder="username" value="{{ old('email') }}">
						</div>
						<div class="form-group">
							<label for="lg_password" class="sr-only">Password</label>
							<input type="password" class="form-control" id="lg_password" name="password" placeholder="password">
						</div>
						<div class="form-group login-group-checkbox">
							<input type="checkbox" id="lg_remember" name="remember">
							<label for="lg_remember">remember</label>
						</div>
					</div>
					<button type="submit" class="login-button">
						<i>GO</i>
						<i class="fa fa-angle-double-right"></i>
					</button>
				</div>
				<div class="etc-login-form">
					<p>forgot your password? <a href="#">click here</a></p>
					<p>new user? <a href="/register">create new account</a></p>
				</div>
			</form>
		</div>
		<!-- end:Main Form -->
	</div>
</div>

@endsection