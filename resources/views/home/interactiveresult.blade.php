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

						<div class="col-xs-12">
							<h3>Here is the correct answer</h3>
							@if($exam->code=='mcburger')
								<div id="flashContent">
									<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="100%" height="400" id="assembler" align="middle">
										<param name="movie" value="{{ asset('/img/interactive/mcburger/assembler.swf') }}" />
										<param name="quality" value="high" />
										<param name="bgcolor" value="#ffffff" />
										<param name="play" value="true" />
										<param name="loop" value="true" />
										<param name="wmode" value="window" />
										<param name="scale" value="showall" />
										<param name="menu" value="true" />
										<param name="devicefont" value="false" />
										<param name="salign" value="" />
										<param name="allowScriptAccess" value="sameDomain" />
										<!--[if !IE]>-->
										<object type="application/x-shockwave-flash" data="{{ asset('/img/interactive/mcburger/assembler.swf') }}" width="550" height="400">
											<param name="movie" value="{{ asset('/img/interactive/mcburger/assembler.swf') }}" />
											<param name="quality" value="high" />
											<param name="bgcolor" value="#ffffff" />
											<param name="play" value="true" />
											<param name="loop" value="true" />
											<param name="wmode" value="window" />
											<param name="scale" value="showall" />
											<param name="menu" value="true" />
											<param name="devicefont" value="false" />
											<param name="salign" value="" />
											<param name="allowScriptAccess" value="sameDomain" />
										<!--<![endif]-->
											<a href="http://www.adobe.com/go/getflash">
												<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
											</a>
										<!--[if !IE]>-->
										</object>
										<!--<![endif]-->
									</object>
								</div>
@elseif($exam->code == "grill")
	<div id="flashContent">
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="100%" height="400" id="assembler" align="middle">
			<param name="movie" value="{{ asset('/img/interactive/grill/assembler.swf') }}" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<param name="play" value="true" />
			<param name="loop" value="true" />
			<param name="wmode" value="window" />
			<param name="scale" value="showall" />
			<param name="menu" value="true" />
			<param name="devicefont" value="false" />
			<param name="salign" value="" />
			<param name="allowScriptAccess" value="sameDomain" />
			<!--[if !IE]>-->
			<object type="application/x-shockwave-flash" data="{{ asset('/img/interactive/grill/assembler.swf') }}" width="550" height="400">
				<param name="movie" value="{{ asset('/img/interactive/grill/assembler.swf') }}" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#ffffff" />
				<param name="play" value="true" />
				<param name="loop" value="true" />
				<param name="wmode" value="window" />
				<param name="scale" value="showall" />
				<param name="menu" value="true" />
				<param name="devicefont" value="false" />
				<param name="salign" value="" />
				<param name="allowScriptAccess" value="sameDomain" />
			<!--<![endif]-->
				<a href="http://www.adobe.com/go/getflash">
					<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
				</a>
			<!--[if !IE]>-->
			</object>
			<!--<![endif]-->
		</object>
	</div>
							@endif

	</div>
</div>


</div>
@endsection
