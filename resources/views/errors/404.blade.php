@extends('mini')
@section('styles')

<link href="{{ asset('css/login.min.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="container">
	<!-- LOGIN FORM -->
	<div class="text-center" style="padding:50px 0">
		<img src="{{ asset('img/logo.png') }}">
		<div class="logo">Not sure where you're going?</div>
		<p style="color:#fff;">The page you are looking for does not exist.</p>
		<label>Go back <a href="/home">Home</a></label>
	</div>
</div>

@endsection