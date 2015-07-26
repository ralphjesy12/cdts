<?php $page = 'training'; ?>
@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="row text-center" style="margin-bottom:30px;">
    <h1>TRAINING MODULES</h1>
</div>
<div class="row" style="margin-bottom:30px;">
    <div class="col-xs-4 text-center">
        <img src="{{ asset('img/training/tsoc.png') }}" height="100px">
        <h3>TSOC</h3>
        <label style="min-height:40px;">Training Station Observation Checklist</label>
        <hr>
        <label>Total</label>
        <small>31 Modules</small><br>
        <label>Viewed</label>
        <small>10 Modules</small><br>
        <a href="/training/browser/tsoc" class="btn btn-sms btn-danger">VIEW ALL</a>
    </div>
    <div class="col-xs-4 text-center">
        <img src="{{ asset('img/training/ops.png') }}" height="100px">
        <h3>OPS</h3>
        <label style="min-height:40px;">Operational Procedure Sheet</label>
        <hr>
        <label>Total</label>
        <small>31 Modules</small><br>
        <label>Viewed</label>
        <small>10 Modules</small><br>
        <a href="/training/browser/ops" class="btn btn-sms btn-danger">VIEW ALL</a>
    </div>
    <div class="col-xs-4 text-center">
        <img src="{{ asset('img/training/videos.png') }}" height="100px" >
        <h3>VIDEOS</h3>
        <label style="min-height:40px;">Instructional Clips</label>
        <hr>
        <label>Total</label>
        <small>31 Modules</small><br>
        <label>Viewed</label>
        <small>10 Modules</small><br>
        <a href="#" class="btn btn-sms btn-danger">VIEW ALL</a>
    </div>
</div>
@endsection