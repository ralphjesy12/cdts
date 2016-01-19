<?php $page = 'reports'; ?>
@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="row text-center" style="margin-bottom:30px;">
    <h1>REPORTS</h1>
</div>
<div class="row" style="margin-bottom:30px;">
    <div class="col-sm-6 text-center">
        <img src="{{ asset('img/assessment/training.png') }}" height="100px">
        <h3>QA Trainings</h3>
        <label style="min-height:40px;">Training Station Observation Checklist</label><hr>
        <form>
            <div class="form-group col-xs-12">
                <input class="form-control input-sm" type="text" placeholder="Search by Crew Name">
                <small class="help-block">Start typing then select crew name. Leave blank to search all</small>
            </div>
            <div class="form-group col-sm-6">
                <input class="form-control input-sm" type="date">
                <small class="help-block">Date From</small>
            </div>
            <div class="form-group col-sm-6">
                <input class="form-control input-sm" type="date">
                <small class="help-block">Date To</small>
            </div>
        </form>
        <a href="/training/browser/tsoc" class="btn btn-sms btn-danger">VIEW REPORT</a>
    </div>
    <div class="col-sm-6 text-center">
        <img src="{{ asset('img/assessment/interactive.png') }}" height="100px">
        <h3>Interactive Exam</h3>
        <label style="min-height:40px;">Training Station Observation Checklist</label><hr>
        <form>
            <div class="form-group col-xs-12">
                <input class="form-control input-sm" type="text" placeholder="Search by Crew Name">
                <small class="help-block">Start typing then select crew name. Leave blank to search all</small>
            </div>
            <div class="form-group col-sm-6">
                <input class="form-control input-sm" type="date">
                <small class="help-block">Date From</small>
            </div>
            <div class="form-group col-sm-6">
                <input class="form-control input-sm" type="date">
                <small class="help-block">Date To</small>
            </div>
        </form>
        <a href="/training/browser/tsoc" class="btn btn-sms btn-danger">VIEW REPORT</a>
    </div>
</div>
@endsection
