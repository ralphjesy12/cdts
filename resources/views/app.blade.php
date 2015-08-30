<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Mcdonald&#39;s Crew Development Training System</title>

		<!-- Bootstrap -->
		<link href="{{ asset('app.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.min.css') }}" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

		@yield('styles')
	</head>
	<body>
		<div class="container">
			<div class="row profile">
				<div class="col-xs-12 text-center">

					<div class="logo"><img src="{{ asset('img/logo.png') }}" style="height: 46px;margin-right: 8px;">Crew Development Training System</div>
				</div>
			</div>
			<div class="row profile">

				<div class="col-xs-3">
					<div class="profile-sidebar">
						<!-- SIDEBAR USERPIC -->
						<div class="profile-userpic">
							<img src="{{ asset('img/profile/' . hash('crc32b',$userobj->id) . '.jpg') }}" class="img-responsive" alt="">
						</div>
						<!-- END SIDEBAR USERPIC -->
						<!-- SIDEBAR USER TITLE -->
						<div class="profile-usertitle">
							<div class="profile-usertitle-name">
								{{ $user['fullname'] }}
							</div>
							<div class="profile-usertitle-job">
								{{ $user['position'] }}
							</div>
						</div>
						<!-- END SIDEBAR USER TITLE -->
						<!-- SIDEBAR BUTTONS -->
						<div class="profile-userbuttons">
							<a href="/logout" class="btn btn-danger btn-sm">Log Out</a>
						</div>
						<!-- END SIDEBAR BUTTONS -->
						<!-- SIDEBAR MENU -->
						<div class="profile-usermenu">
							<ul class="nav">
								<li class="{{ isset($page) && $page=='home' ? 'active' : '' }}"><a href="/home"><i class="fa fa-fw fa-home"></i>Dashboard</a></li>






								<li class="{{ isset($page) && $page=='training' ? 'active' : '' }}"><a href="/training"><i class="fa fa-fw fa-flag"></i>Training</a></li>
								<li class="{{ isset($page) && $page=='assessment' ? 'active' : '' }}"><a href="/assessment"><i class="fa fa-fw fa-bolt"></i>Assessment</a></li>
								@if($user['level']>2)
								<li class="{{ isset($page) && $page=='reports' ? 'active' : '' }}"><a href="/reports"><i class="fa fa-fw fa-print"></i>Reports</a></li>
								@endif	
								<li class="{{ isset($page) && $page=='activity' ? 'active' : '' }}"><a href="/activity"><i class="fa fa-fw fa-rss"></i>Activity</a></li>

								<li class="{{ isset($page) && $page=='account' ? 'active' : '' }}"><a href="/account"><i class="fa fa-fw fa-user"></i>Account</a></li>
							</ul>
						</div>
						<!-- END MENU -->
					</div>
				</div>
				<div class="col-xs-9">
					<div class="profile-content">
						@yield('content')
					</div>
				</div>
			</div>
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="{{ asset('app.min.js') }}"></script>
		<!-- Google Fonts embed code -->
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script>
			$(function(){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data: {
						_token: $('meta[name="csrf-token"]').attr('content')
					}
				});
			});
		</script>

		@yield('scripts')

	</body>
</html>