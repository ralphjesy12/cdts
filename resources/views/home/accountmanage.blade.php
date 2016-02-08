<?php $page = 'account';?>
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
				<li>
					<a href="/account">Manage Account</a>
				</li>
				<li class="active">
					<a href="#tab_mu" data-toggle="tab">Manage Users</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active table-responsive" id="tab_mu">
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
					<table class="table table-bordered table-hover table-striped table-condensed">
						<thead>
							<th>#</th>
							<th>Full Name</th>
							<th>User Name</th>
							<th>Email</th>
							<th>Contact</th>
							<th>Station</th>
							<th>Position</th>
							<th>Level</th>
							<th>Join Date</th>
							<th>Actions</th>
						</thead>
						<tbody>
							@foreach ($users as $k=>$u)
								<tr data-id="{{ $u->id }}">
									<td>{{ $u->id }}</td>
									<td>{{ $u->fullname }}</td>
									<td>{{ $u->username }}</td>
									<td>{{ $u->email }}</td>
									<td>{{ $u->contact }}</td>
									<td>{{ $u->station }}</td>
									<td>{{ $u->position }}</td>
									<td>{{ $u->level }}</td>
									<td><span title="{{ $u->created_at->toRfc850String() }}">{{ $u->created_at->diffForHumans() }}</span></td>
									<td>
										<div class="btn-group">
											<a href="#" class="btn btn-default btn-xs btn-edit"><i class="fa fa-edit"></i></a>
											@if($u->id == $user['id'])
												<a href="#" class="btn btn-warning btn-xs" data-toggle="tooltip" title="You cannot delete your own account"><i class="fa fa-trash"></i></a>
											@else
												<a href="#" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash"></i></a>
											@endif
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<th colspan="10" class="text-right">
								<div class="btn-group">
									<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-add-user"><i class="fa fa-fw fa-plus"></i>Add User</button>
								</div>
							</th>
						</tfoot>
					</table>
					@if($users->currentPage()==1 && !$users->hasMorePages())
						<ul class="pagination">
							<li class="disabled"><span>«</span></li>
							<li class="active"><span>1</span></li>
							<li class="disabled"><span>»</span></li>
						</ul>
					@else
						{!! $users->render() !!}
					@endif
				</div>
			</div>
		</div>
	</div>




	<!-- Modal -->
	<div class="modal fade" id="modal-add-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add User</h4>
				</div>
				<div class="modal-body">

					<form id="register-form" class="text-left" method="POST" action="/form/createuser">
						{!! csrf_field() !!}

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

								<div class="form-group">
									<label for="reg_station" class="sr-only">Station</label>
									<input type="text" class="form-control" id="reg_station" name="station" placeholder="station">
								</div>
								<div class="form-group">
									<label for="reg_fullname" class="sr-only">Position</label>
									<select class="form-control"name="position" >
										<option>Crew</option>
										<option>Crew Chief</option>
										<option>Manager</option>
										<option>Head</option>
										@if($user['level'] == 4)
											<option>Admin</option>
										@endif
									</select>
								</div>

								<div class="form-group login-group-checkbox">
									<input type="radio" class="" name="gender" id="male" value="male">
									<label for="male">male</label>

									<input type="radio" class="" name="gender" id="female" value="female">
									<label for="female">female</label>
								</div>
							</div>
							<button type="submit" class="login-button btn btn-danger btn-sm">Go<i class="fa fa-fw fa-angle-double-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="modal-add-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit User</h4>
				</div>
				<div class="modal-body">
					<form id="register-form" class="text-left" method="POST" action="/form/edituser">
						{!! csrf_field() !!}
						<input type="hidden" name="id">
						<div class="main-login-form">
							<div class="login-group">
								<div class="form-group">
									<label for="reg_username" class="sr-only">Username</label>
									<input type="text" class="form-control" id="reg_username" name="username" placeholder="username" value="{{ old('name') }}">
								</div>
								<div class="form-group">
									<label for="reg_password" class="sr-only">New Password</label>
									<input type="password" class="form-control" id="reg_newpassword" name="newpassword" placeholder="new password">
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
								<div class="form-group">
									<label for="reg_station" class="sr-only">Station</label>
									<input type="text" class="form-control" id="reg_station" name="station" placeholder="station">
								</div>
								<div class="form-group">
									<label for="reg_fullname" class="sr-only">Position</label>
									<select class="form-control"name="position" >
										<option>Crew</option>
										<option>Crew Chief</option>
										<option>Manager</option>
										<option>Head</option>
										@if($user['level'] == 4)
											<option>Admin</option>
										@endif
									</select>
								</div>

								<div class="form-group login-group-checkbox">
									<input type="radio" class="" name="gender" id="male" value="male">
									<label for="male">male</label>

									<input type="radio" class="" name="gender" id="female" value="female">
									<label for="female">female</label>
								</div>
								<h4>Permissions</h4>
								<div class="checkbox">
									<label>
										<input type="checkbox" class="form-cotrol"> Manage User Permissions
									</label>
								</div>
								<br/>
								<br/>
							</div>
							<button type="submit" class="login-button btn btn-danger btn-sm">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
