<?php $page = 'account'; ?>
@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
@endsection
@section('scripts')
<script type="application/javascript" src="{{ asset('js/accounts.js') }}"></script>
@endsection

@section('content')
<div class="tabbable-panel">
	<div class="tabbable-line">
		<ul class="nav nav-tabs ">
			<li class="active">
				<a href="#tab_ma" data-toggle="tab">Manage Account</a>
			</li>
			<li>
				<a href="/account/manage">Manage Users</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_ma">
				<div class="row">
					<div class="col-md-3 col-lg-3 " align="center"> 
						<img alt="User Pic" src="/img/profile/profile_user.jpg" class="img-circle img-responsive"> 
					</div>
					<div class=" col-md-9 col-lg-9 "> 
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
						<table class="table table-user-information">
							<tbody>
								<tr>
									<td>Fullname</td>
									<td>{{ $userobj->fullname }}</td>
								</tr>
								<tr>
									<td>Username</td>
									<td>{{ $userobj->username }}</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>{{ $userobj->email }}</td>
								</tr>
								<tr>
									<td>Position</td>
									<td>{{ $userobj->position }}</td>
								</tr>
								<tr>
									<td>Gender</td>
									<td>{{ $userobj->gender }}</td>
								</tr>
								<tr>
									<td>Join Date</td>
									<td><span title="{{ $userobj->created_at->toRfc850String() }}">{{ $userobj->created_at->diffForHumans() }}</span></td>
								</tr>
							</tr>
						</tbody>
					</table>
				<a href="#modal-profile-edit" class="btn btn-update-profile btn-danger btn-primary" data-toggle="modal">Update Profile</a>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<div class="modal fade" id="modal-profile-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Update Profile</h4>
			</div>
			<div class="modal-body">
				<form id="register-form" class="text-left" method="POST" action="/form/editprofile">
					{!! csrf_field() !!} 
					<div class="main-login-form">
						<div class="login-group">
							<div class="form-group">
								<label for="reg_fullname" class="sr-only">Full Name</label>
								<input type="text" class="form-control" id="reg_fullname" name="fullname" placeholder="full name" value="{{ $userobj->fullname }}">
							</div>
							<div class="form-group">
								<label for="reg_username" class="sr-only">Username</label>
								<input type="text" class="form-control" id="reg_username" name="username" placeholder="username"  value="{{ $userobj->username }}">
							</div>
							<div class="form-group">
								<label for="reg_email" class="sr-only">Email</label>
								<input type="email" class="form-control" id="reg_email" name="email" placeholder="email"  value="{{ $userobj->email }}">
							</div>

							<div class="form-group login-group-checkbox">
								<input type="radio" class="" name="gender" id="male" value="male" @if($userobj->gender == 'male') checked @endif </input>
							<label for="male">male</label>

							<input type="radio" class="" name="gender" id="female" value="female" @if($userobj->gender == 'female') checked @endif </input>
						<label for="female">female</label>
					</div>
					<div class="form-group">
						<label for="reg_password" class="sr-only">Password</label>
						<input type="password" class="form-control" id="reg_newpassword" name="password" placeholder="verify password" required>
					</div>
					<hr>
					<div class="form-group">
						<label for="reg_password" class="sr-only">New Password</label>
						<input type="password" class="form-control" id="reg_newpassword" name="newpassword" placeholder="new password">
					</div>
					<div class="form-group">
						<label for="reg_password_confirm" class="sr-only">Password Confirm</label>
						<input type="password" class="form-control" id="reg_password_confirm" name="newpassword_confirmation" placeholder="confirm password">
					</div>
					</div>
				<button type="submit" class="login-button btn btn-danger btn-sm">Update</button>
			</div>
			</form>
	</div>
</div>
</div>
</div>
@endsection