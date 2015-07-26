<?php $page = 'assessment'; ?>
@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="row text-center" style="margin-bottom:30px;">
    <h1>ASSESSMENT</h1>
</div>
<div class="row" style="margin-bottom:30px;">
    <div class="col-xs-4 text-center">
            <img src="{{ asset('img/assessment/verification.png') }}" height="100px">
        <h3>VERIFICATION</h3>
        <hr>
        <label>Date Taken</label>
        <small>Jan 31, 1994</small><br>
        <label>Status</label>
        <small>Completed</small><br>
        <label>Score</label>
        <small>100%</small><br>
        <label>Retries Left</label>
        <small>0</small><br><br>
        <a href="/assessment/exams/verification" class="btn btn-sms btn-danger">TAKE EXAM</a>
    </div>
    <div class="col-xs-4 text-center">
            <img src="{{ asset('img/assessment/training.png') }}" height="100px">
        <h3>TRAINING</h3>
        <hr>
        <label>Date Taken</label>
        <small>Jan 31, 1994</small><br>
        <label>Status</label>
        <small>Completed</small><br>
        <label>Score</label>
        <small>100%</small><br>
        <label>Retries Left</label>
        <small>3</small><br><br>
        <a href="/assessment/exams/training" class="btn btn-sms btn-danger">TAKE EXAM</a>
    </div>
    <div class="col-xs-4 text-center">
            <img src="{{ asset('img/assessment/interactive.png') }}" height="100px" >
        <h3>INTERACTIVE</h3>
        <hr>
        <label>Date Taken</label>
        <small>Jan 31, 1994</small><br>
        <label>Status</label>
        <small>Completed</small><br>
        <label>Score</label>
        <small>100%</small><br>
        <label>Retries Left</label>
        <small>3</small><br><br>
        <a href="/assessment/exams/interactive" class="btn btn-sms btn-danger">TAKE EXAM</a>
    </div>
</div>
@endsection