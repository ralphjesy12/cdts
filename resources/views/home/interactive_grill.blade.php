<?php $page = 'assessment'; ?>

@extends('app')
@section('styles')
	<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/interactive.min.css') }}" rel="stylesheet">
@endsection
@section('scripts')
	{{-- <script src="{{ asset('js/interactive.js') }}"></script> --}}
	<script>
	$(function(){
		function alignCenter(id,index){
			var elem = $(id);
			var offset = 20;
			if(elem){
				elem.css({
					top : (( elem.parent().height() / 2 ) - ( elem.height() / 2)) - (index * offset),
					left : ( elem.parent().width() / 2 ) - ( elem.width() / 2),
				})
			}
		}

		$('#ingredient-box .item').click(function(event){
			event.preventDefault();
			// Create a clone from current position
			var thisimg = $(this).find('img').first();
			var thisimgstats = thisimg.offset();
			var cloneimg = thisimg.clone();
			cloneimg.css({
				top : thisimgstats.top,
				left : thisimgstats.left,
				width : thisimg.width(),
				height : thisimg.height(),
				position : 'absolute'
			});
			cloneimg.appendTo('body');
			cloneimg.addClass('animate ingredients');
			cloneimg.data('step',thisimg.data('step'));
			$('#submission-form').append('<input type="hidden" name="steps[]" value="' + thisimg.data('step') + '">')

			// Animate to the topcenter of the assembly tray
			setTimeout(function(){
				var traystats = $('#assembly-tray').offset();
				var traywidth = $('#assembly-tray').width();
				var trayheight = $('#assembly-tray').height();
				cloneimg.css({
					top : traystats.top + (trayheight / 2) - (cloneimg.height() / 2) ,
					left : traystats.left + ( traywidth / 2) - (cloneimg.width() / 2)
				});
				setTimeout(function(){

						var newsrc = cloneimg.attr('data-swf');
					$('#assembly-tray').html('<object codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" type="application/x-oleobject"> <param name="src" value="' + newsrc + '" style="width:100%;height:100%;"> <param name="quality" value="high" /> <param name="bgcolor" value="#ffffff" /> <param name="play" value="true" /> <param name="loop" value="true" /> <param name="wmode" value="window" /> <param name="scale" value="showall" /> <param name="menu" value="true" /> <param name="devicefont" value="false" /> <param name="salign" value="" /> <param name="allowScriptAccess" value="sameDomain" /> <embed src="' + newsrc + '" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"  style="width:100%;height:100%;"></embed> </object>');
					cloneimg.remove();
				},300)
			},300)
		});

		var bgwidth = 1320;
		var bgheight = 1213;

		$(window).resize(function(){

			// Resize Assembly Tray
			var curwidth = $('#assembly-tray').width();
			var newheight = ( curwidth / bgwidth ) * bgheight;
			$('#assembly-tray').css('height',newheight);
		});

		$(window).trigger('resize');
	});
	</script>
@endsection

@section('content')
	<div id="interactive" class="dash-panel">
		<div class="panel-body text-center">
			<h2>GRILL STATION</h2>
			<h3>HERE ARE THE AVAILABLE INGREDIENTS</h3>
			<ul id="ingredient-box" class="interactiveLists">
				<?php
				$steps = [
					[
						'step' => 'Place patty on the grill',
						'thumb' => 'step1.jpg',
						'swf' => 'step1.swf',
					],
					[
						'step' => 'Press green button to close grill',
						'thumb' => 'step2.jpg',
						'swf' => 'step2.swf',
					],
					[
						'step' => 'Grill opens automatically',
						'thumb' => 'step3.png',
						'swf' => 'step3.swf',
					],
					[
						'step' => 'Transfer patties',
						'thumb' => 'step4.jpg',
						'swf' => 'step4.swf',
					]
				];
				?>
				@foreach($steps as $k=>$s)
					<li>
						<div class="item">
							<a href="#">
								<img src="{{ asset('img/interactive/grill/'.($s['thumb']).'') }}" alt="{{ str_slug($s['step']) }}" data-swf="{{ asset('img/interactive/grill/'.($s['swf']).'') }}" class="img-responsive" data-step="{{ ($k+1) }}">
							</a>
							<input type="hidden" name="steps[]" value="{{ $k }}">
							<div class="content">
								<a href="#" class="icon bg-red "><i class="fa fa-plus"></i></a>
								<label>{{ $s['step'] }}</label>
								<p> </p>
							</div>
						</div>
					</li>
				@endforeach
			</ul>
			<div id="assembly-tray" style="background-image:url('{{ asset('img/interactive/grill/stage.jpg') }}')">
			</div>

			<form id="submission-form" action="/form/saveAnswerInteractivegrill" method="POST">
				{!! csrf_field() !!}
				<input type="hidden" name="code" value="grill">
				<h3>NOW LET'S CHECK IF YOU GOT IT RIGHT</h3>
				<button id="btn-check" class="btn btn-warning btn-lg">CHECK MY RECIPE</button>
			</form>
		</div>
	</div>
@endsection
