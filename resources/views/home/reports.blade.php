<?php $page = 'reports'; ?>
@extends('app')
@section('styles')
    <link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row text-center" style="margin-bottom:30px;">
        <h1>REPORTS</h1>
    </div>
    <div class="row hidden" style="margin-bottom:30px;">
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
    <div class="row" style="margin-bottom:30px;">
        <div class="col-xs-12">
            <h4>Search Reports</h4>
            <form method="GET">
                <div class="form-group col-xs-6">
                    <small class="help-block">Type keywords to search name. Leave blank to search all</small>
                    <input class="form-control input-sm" type="text" placeholder="Search by Crew Name" name="key">
                </div>
                <div class="form-group col-xs-6">
                    <small class="help-block">Examination Type</small>
                    <select class="form-control input-sm" name="type">
                        <option {{ $input['type'] && $input['type']=='Verification' ? 'selected' : '' }}>Verification</option>
                            <option {{ $input['type'] && $input['type']=='Training' ? 'selected' : '' }}>Training</option>
                        <option {{ $input['type'] && $input['type']=='Interactive' ? 'selected' : '' }}>Interactive</option>
                    </select>
                </div>
                <div class="form-group col-xs-6">
                    <small class="help-block">Date From</small>
                    <input class="form-control input-sm" type="date" max="{{ date('Y-m-d') }}" value="{{ $input['from'] or '2016-01-01' }}" name="from">
                </div>
                <div class="form-group col-xs-6">
                    <small class="help-block">Date To</small>
                    <input class="form-control input-sm" type="date" max="{{ date('Y-m-d') }}" value="{{ $input['to'] or date('Y-m-d') }}" name="to">
                </div>
                <div class="col-xs-12">
                    <button class="btn btn-danger btn-xs" type="submit">Search Reports</button>
                </div>
            </form>
        </div>
        @if(count($users))
        <div class="col-xs-12">
            <hr>
            <div class="list-group">
                <a href="#" class="list-group-item" target="_blank">
                    <i class="fa fa-file fa-fw pull-left"></i>
                    <span class="list-heading">All Interactive Exams</span>
                </a>
                @foreach($users as $u)
                        <a href="{{ action('StaticsController@reportsview',array_merge($input,[
                            'user' => $u->id
                            ])) }}" class="list-group-item" target="_blank">
                            <i class="fa fa-user fa-fw pull-left"></i>
                            <span class="list-heading">{{ $u->fullname }}</span>
                            <small>{{ $u->email }}</small>
                        </a>
                @endforeach
            </div>
        </div>
    @endif
    </div>
@endsection
