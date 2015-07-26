<?php $page = 'assessment'; ?>
@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="row text-center" style="margin-bottom:30px;">
    <h3>Exam 10293123 : Exam Title</h3>
    <h5>Questions 1 of 10</h5>
</div>
<div class="row" style="margin-bottom:30px;">
    <div class="col-xs-12">
        <form>
            <h4>What is the answer for this question?</h4>
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" required>
                    Option one is this and that&mdash;be sure to include why it's great
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" required>
                    Option one is this and that&mdash;be sure to include why it's great
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" required>
                    Option one is this and that&mdash;be sure to include why it's great
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" required>
                    Option one is this and that&mdash;be sure to include why it's great
                </label>
            </div>
            <div class="pull-right">
                <button class="btn btn-danger">Next Question</button>
            </div>
        </form>
    </div>
</div>
@endsection