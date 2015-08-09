<?php $page = 'assessment'; ?>
@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@if($status=="start")
<div class="row text-center" style="margin-bottom:30px;">
	<h3>{{ $exam->title }}</h3>
	<h4>{{ $exam->code }}</h4>
	<h5>Start Exam</h5>
</div>
<div class="row">
	<div class="col-xs-4">
		<h4>Test Coverage</h4>
		<ul class="list-unstyled">
			<li><b>Title</b> : {{ $exam->title }}</li>
			<li><b>Type</b> : {{ $exam->type }}</li>
			<li><b>Items</b> : {{ $exam->items }}</li>
			<li><b>Attempts</b> : {{ $exam->attempts }}</li>
		</ul>
	</div>
	<div class="col-xs-8">
		<h4>Test Guidelines</h4>
		<ol>
			<li>You MAY  log out at any time and continue the test at a later time. When you log back in, you will continue where you left off.</li>
			<li>If the assessment freezes at any point, refresh (CTRL + R) and the assessment should continue as expected.</li>
		</ol>
	</div>
	<div id="btn-start-div" class="col-xs-6 col-xs-offset-3 text-center" style="padding-top:40px;">
		<a id="btn-start" href="/assessment/exams/{{ $exam->code }}/1" class="btn btn-warning btn-lg btn-block btn-3d-orange">Start Exam</a>
		<small>Exam will automatically start in <span>5</span> second/s</small>
	</div>
</div>

@section('scripts')
<script>
	$(function(){
		var start = 4;
		var loop = setInterval(function(){
			$('#btn-start-div span').text(start--);
			if(start<0){
				clearInterval(loop);				
				window.location.assign($('#btn-start').attr('href'));
			}
		},1000);

	});
</script>
@endsection
@elseif($status=='exam')
<div class="row text-center" style="margin-bottom:30px;">
	<h3>{{ $exam->title }}</h3>
	<h4>{{ $exam->code }}</h4>
	<h5>Questions {{ $question['questionid'] }} of {{ $exam->items }}</h5>
</div>
<div class="row" style="margin-bottom:30px;">
	<div class="col-xs-12">
		<form action="/form/saveAnswer" method="post">
			{!! csrf_field() !!}
			<input type="hidden" name="exam" value="{{ $exam->id }}">
			<input type="hidden" name="examcode" value="{{ $exam->code }}">
			<input type="hidden" name="item" value="{{ $question['questionid'] }}">
			<input type="hidden" name="assessment" value="{{ $assessment['id'] }}">
			<input type="hidden" name="question" value="{{ $question['id'] }}">
			<input type="hidden" name="user" value="{{ $user['id'] }}">
			<h4>{{ $question['body'] }}</h4>
			@foreach($question['choices'] as $k=>$q)
			<div class="radio">
				<label>
					<input type="radio" name="answer" id="optionsRadios{{ $k }}" value="{{ $q['id'] }}" required>
					{{ $q['text'] }}
				</label>
			</div>
			@endforeach
			<div class="pull-right">
				<button class="btn btn-danger">Next Question</button>
			</div>
		</form>
	</div>
</div>
@else
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
			<li><b>Attempts</b> : {{ $exam->attempts }}</li>
		</ul>
	</div>
	<div class="col-xs-4">
		<h4>Score</h4>
		<ul class="list-unstyled">
			<li><b>Correct</b> : {{ $score['correct'] }}</li>
			<li><b>Answered</b> : {{ $score['answered'] }}</li>
			<li><b>Total</b> : {{ $score['total'] }}</li>
			<li><b>Score</b> : {{ ( $score['correct'] / $score['total'] ) }}</li>
		</ul>
	</div>
	<div class="col-xs-4 text-center">
		<h1>{{ number_format(( $score['correct'] / $score['total'] )*100,2) . '%' }}</h1>
		<h3>Score</h3>
		<a class="btn btn-danger btn-block" href="/assessment">Go Back to Assessments</a>
	</div>
</div>
@endif
@endsection
