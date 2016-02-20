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
					// cloneimg.remove();
				},300)
			},300)
		});

		var bgwidth = 2134;
		var bgheight = 776;

		$(window).resize(function(){

			// Resize Assembly Tray
			var curwidth = $('#assembly-tray').width();
			var newheight = ( curwidth / bgwidth ) * bgheight;
			$('#assembly-tray').css('height',newheight);
			alignCenter('img.stage',0);
		});

		$(window).trigger('resize');
	});
	</script>
@endsection

@section('content')
	<div id="interactive" class="dash-panel">
		<div class="panel-body text-center">
			<h2>McBurger Assembly</h2>
			<h3>HERE ARE THE AVAILABLE INGREDIENTS</h3>
			<ul id="ingredient-box" class="interactiveLists">
				<?php
				$steps = [
					'Buns',
					'Mayonaise',
					'Shredded Lettuce',
					'Tomato',
					'Cheese',
					'Patty'
				];
				?>
				@foreach($steps as $k=>$s)
					<li>
						<div class="item">
							<a href="#">
								<img src="{{ asset('img/interactive/mcburger/step'.($k+1).'.png') }}" alt="{{ str_slug($s) }}" class="img-responsive" data-step="{{ ($k+1) }}">
							</a>
							<input type="hidden" name="steps[]" value="{{ $k }}">
							<div class="content">
								<a href="#" class="icon bg-red "><i class="fa fa-plus"></i></a>
								<label>{{ $s }}</label>
								<p> </p>
							</div>
						</div>
					</li>
				@endforeach
			</ul>
			<div id="assembly-tray" style="background-image:url('{{ asset('img/interactive/mcburger/background.png') }}')">
				<img src="{{ asset('img/interactive/mcburger/stage.png') }}" class="stage">
			</div>

			<form id="submission-form" action="/form/saveAnswerInteractiveMcburger" method="POST">
				{!! csrf_field() !!}
				<input type="hidden" name="code" value="mcburger">
				<h3>NOW LET'S CHECK IF YOU GOT IT RIGHT</h3>
				<button id="btn-check" class="btn btn-warning btn-lg">CHECK MY RECIPE</button>
			</form>
		</div>
	</div>
@endsection
