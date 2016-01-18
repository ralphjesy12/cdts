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
					<li><b>Type</b> : {{ $exam->type }}</li>
					<li><b>Items</b> : {{ $exam->items }}</li>
					<li><b>Attempts</b> : {{ $attempts }} / {{ $exam->attempts }}</li>
				</ul>
			</div>
			<div class="col-xs-4">
				<h4>Score</h4>
				<ul class="list-unstyled">
					<li><b>Score</b> : {{ $assessment->score==1 ? ( 100 - (($attempts-1)*10) . '%' ) : 'Failed'}}</li>
					<li><b>Time</b> : <?php
					$datetime1 = new DateTime($assessment->created_at);
					$datetime2 = new DateTime($assessment->updated_at);
					$interval = $datetime1->diff($datetime2);
					echo $interval->format('%H:%I:%S');
					?></li>
				</ul>
			</div>
			<div class="col-xs-4 text-center">
				<h1>{{ $assessment->score==1 ? ( 100 - (($attempts-1)*10) . '%' ) : 'Failed'}}</h1>
				<h3>Score</h3>
				@if($assessment->score<1)
				<a class="btn btn-warning btn-block" href="/assessment/interactive/{{ $exam->code }}">Retake Exam</a><br>
				@endif
				<a class="btn btn-danger btn-block" href="/assessment">Go Back to Assessments</a>
			</div>
	</div>
</div>


</div>
@endsection
