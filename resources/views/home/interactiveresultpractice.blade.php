<?php $page = 'assessment'; ?>

@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/interactive.min.css') }}" rel="stylesheet">
@endsection
@section('scripts')
<script src="{{ asset('js/interactive.js') }}"></script>
@endsection

@section('content')
<div id="interactive" class="dash-panel">
	<div class="panel-body text-center">
		<div class="row text-center" style="margin-bottom:30px;">
			<h3>{{ $exam->title }}</h3>
			<h4>{{ $exam->code }}</h4>
			<h5>Exam Result</h5>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<h4>Test Coverage</h4>
				<ul class="list-unstyled">
					<li><b>Title</b> : {{ $exam->title }}</li>
					<li><b>Type</b> : {{ $exam->type }} (Practice)</li>
					<li><b>Items</b> : {{ $exam->items }}</li>
					<li><b>Attempts</b> : {{ $attempts }}</li>
				</ul>
			</div>
			<div class="col-xs-4">
				<h4>Score</h4>
				<ul class="list-unstyled">
					<li><b>Score</b> : {{ $assessment->score==1 ? ( 100 - (($attempts-1)*0) . '%' ) : 'Failed'}}</li>
					<li><b>Time</b> : <?php
					$datetime1 = new DateTime($assessment->created_at);
					$datetime2 = new DateTime($assessment->updated_at);
					$interval = $datetime1->diff($datetime2);
					echo $interval->format('%H:%I:%S');
					?></li>
				</ul>
			</div>
			<div class="col-xs-4 text-center">
				<h1>{{ $assessment->score==1 ? ( 100 - (($attempts-1)*0) . '%' ) : 'Failed'}}</h1>
				<h3>Score</h3>
				@if($assessment->score<1)
				<a class="btn btn-warning btn-block" href="/assessment/interactivepractice/{{ $exam->code }}">Retake Practice Exam</a><br>
				@endif
				<a class="btn btn-danger btn-block" href="/assessment">Go Back to Assessments</a>
			</div>

			<div class="col-xs-12">
				<h3>Here is the correct answer</h3>
				<ul id="recipe-box" class="interactiveLists" style="pointer-events:none;">
					@foreach($correct as $c)
					<li>
						<div class="item">
							<!-- Image -->
							<a href="#">
								<img src="{{ asset( 'images/steps/' . $c->image ) }}" alt="juice-patty" class="img-responsive">
							</a>
							<!-- Content -->
							<div class="content">
								<!-- Icon -->
								<a href="#" class="icon bg-red"><i class="fa fa-plus"></i></a>
								<!-- Heading -->
								<label>{{ $c->title }}</label>
								<!-- Para -->
								<p>{{ $c->desc }}</p>
							</div>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>


</div>
@endsection
