<?php $page = 'assessment'; ?>
@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<ol class="breadcrumb">
	<li><a href="/assessment">Assessment</a></li>
	<li class="active">{{ ucfirst(strtolower($type)) }}</li>
</ol>
<div class="row text-center" style="margin-bottom:30px;">
    <h3>{{ strtoupper($type) }}</h3>
</div>

<div class="row" style="margin-bottom:30px;">
    @if(count($exams)>0)
	@foreach($exams as $e)
    <div class="col-xs-6">
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGVhNDJhZTlmMyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZWE0MmFlOWYzIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNC41IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{ $e['title'] }}</h4>
                <ul class="list-unstyled">
                    <li>Total : <small>{{ $e['questions'] }} Questions</small></li>
                    <li>Trials : <small>{{ $e['trials'] }}/{{ $e['attempts'] }} Attempts</small></li>
                    <li>Score : <small>{{ $e['score'] ? number_format($e['score']*100,2).'%' : 'Not Taken Yet'}}</small></li>
                </ul>
            </div>
            <div class="media-right">
                <a href="/assessment/exams/{{ $e['code'] }}/0" class="btn btn-danger <?=( $e['trials']>=$e['attempts'] ? 'disabled' : '' )?>" <?=( $e['trials']>=$e['attempts'] ? 'disabled' : '' )?>>Take Exam</a>
            </div>
        </div>
    </div>
@endforeach
@else
	 <div class="col-xs-12">
        <div class="alert alert-danger" role="alert">
			There are no exams found in this category.<br>
			<a href="/assessment" class="alert-link">Click here to go back</a>.
		 </div>
    </div>
@endif
</div>
@endsection