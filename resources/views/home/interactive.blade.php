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
					
					<h3>HERE ARE THE AVAILABLE STEPS</h3>
					<ul id="ingredient-box" class="interactiveLists">
						@foreach( $steps as $s)
											 <li>
						<div class="item">
							<!-- Image -->
							<a href="#">
								<img src="{{ asset( 'images/steps/' . $s['image'] ) }}" alt="{{ str_slug($s['title'],'-') }}" class="img-responsive">
							</a>
							<!-- Content -->
							<div class="content">
								<!-- Icon -->
								<a href="#" class="icon bg-red"><i class="fa fa-plus"></i></a>
								<!-- Heading -->
								<label>{{ $s['title'] }}</label>
								<!-- Para -->
								<p>{{ $s['desc'] }}</p>
							</div>
						</div>
						</li>
					@endforeach
					</ul>
				<h3>DROP THEM HERE IN THEIR CORRECT ORDER</h3>
				<ul id="recipe-box" class="interactiveLists">
					<li class="ui-state-highlight"></li>
				</ul>
				<h3>NOW LET'S CHECK IF YOU GOT IT RIGHT</h3>
				<button id="btn-check" class="btn btn-warning btn-lg">CHECK MY RECIPE</button>
			</div>
		</div>
@endsection