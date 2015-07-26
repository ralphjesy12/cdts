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
						@for( $i = 0 ; $i < 5 ; $i++)
											 <li>
						<div class="item">
							<!-- Image -->
							<a href="#">
								<img src="{{ asset('img/interactive/chix/1.jpg') }}" alt="" class="img-responsive">
							</a>
							<!-- Content -->
							<div class="content">
								<!-- Icon -->
								<a href="#" class="icon bg-red"><i class="fa fa-plus"></i></a>
								<!-- Heading -->
								<label>FRY</label>
								<!-- Para -->
								<p>This is the description about the frying</p>
							</div>
						</div>
						</li>
					@endfor
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