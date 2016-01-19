<?php $page = 'home'; ?>
@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="plugins/jquery.datetimepicker.css"/ >
<link rel="stylesheet" href="css/calendar.css">
<style>
	#calendar .cal-cell .addEvent{
		opacity: 0;
		cursor:pointer;
		transition : opacity 200ms ease-in;
		font-size: 10px;
		color: #B9B9B9;
		position: absolute;
		top: 0;
		margin: 3px auto;
		width: 100%;
		display: block;
		text-align: center;
	}
	#calendar .cal-cell:hover .addEvent{
		opacity: 1;
	}

</style>
@endsection
@section('scripts')
<script type="text/javascript" src="plugins/underscore-min.js"></script>
<script src="plugins/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="js/calendar.js"></script><script type="text/javascript">
var calendar = $("#calendar").calendar(
	{
		tmpl_path: "/tmpls/",
		events_source: function () { return [
			{
				"id": 293,
				"title": "Event 1",
				"url": "http://example.com",
				"class": "event-important",
				"start": 12039485678000, // Milliseconds
				"end": 1234576967000 // Milliseconds
			}
		]; },
		modal: "#events-modal"
	});  


(function($) {

	"use strict";

	var options = {
		events_source: "/form/getEvents",
		view: 'month',
		tmpl_path: 'tmpls/',
		modal: "#events-modal",
		modal_type : "template",
		tmpl_cache: false,
		display_week_numbers: false,
		weekbox: false,
		onAfterEventsLoad: function(events) {
			//			if(!events) {
			//				return;
			//			}
			//			var list = $('#eventlist');
			//			list.html('');
			//
			//			$.each(events, function(key, val) {
			//				$(document.createElement('li'))
			//					.html('<a href="' + val.url + '">' + val.title + '</a>')
			//					.appendTo(list);
			//			});
		},
		onAfterViewLoad: function(view) {
			$('.page-header h3').text(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
			if(view == "month") {
				$("#calendar .cal-cell").delegate('.addEvent','click',function(e) {
					var clicked_date = $(this).siblings('.cal-month-day').find('span').attr('data-cal-date');
					//Do whatever you want. probably, a $.post or something to add the record on your db
					$('#events-add input[type="datetime"].start').val(clicked_date);
					$('#events-add').modal('show');
				});
			}
			$("#calendar .cal-cell").append('<span class="addEvent"><i class="fa fa-plus fa-fw"></i>Add Event</span>');

		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};
	$('#events-add').on('hide.bs.modal',function(){
		$('input[type="datetime"].end').val('');
	});
	var calendar = $('#calendar').calendar(options);

	$('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

	$('.btn-group button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
		});
	});

	$('#first_day').change(function(){
		var value = $(this).val();
		value = value.length ? parseInt(value) : null;
		calendar.setOptions({first_day: value});
		calendar.view();
	});

	$('#language').change(function(){
		calendar.setLanguage($(this).val());
		calendar.view();
	});

	$('#events-in-modal').change(function(){
		var val = $(this).is(':checked') ? $(this).val() : null;
		calendar.setOptions({modal: val});
	});
	$('#format-12-hours').change(function(){
		var val = $(this).is(':checked') ? true : false;
		calendar.setOptions({format12: val});
		calendar.view();
	});
	$('#show_wbn').change(function(){
		var val = $(this).is(':checked') ? true : false;
		calendar.setOptions({display_week_numbers: val});
		calendar.view();
	});
	$('#show_wb').change(function(){
		var val = $(this).is(':checked') ? true : false;
		calendar.setOptions({weekbox: val});
		calendar.view();
	});
	$('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
		//e.preventDefault();
		//e.stopPropagation();
	});
}(jQuery));

$(function(){
	$('input[type="datetime"]').datetimepicker();


	jQuery('input[type="datetime"].start').datetimepicker({
		format:'Y/m/d',
		onShow:function( ct ){
			this.setOptions({
				maxDate:jQuery('input[type="datetime"].end').val()?jQuery('input[type="datetime"].end').val():false
			})
		},
		timepicker:true
	});
	jQuery('input[type="datetime"].end').datetimepicker({
		format:'Y/m/d',
		onShow:function( ct ){
			this.setOptions({
				minDate:jQuery('input[type="datetime"].start').val()?jQuery('input[type="datetime"].start').val():false
			})
		},
		timepicker:true
	});
});
</script>
@endsection
@section('content')
<div class="page-header">
	<div class="pull-right form-inline">
		<div class="btn-group">
			<button class="btn btn-danger" data-calendar-nav="prev">&lt;&lt; Prev</button>
			<button class="btn" data-calendar-nav="today">Today</button>
			<button class="btn btn-danger" data-calendar-nav="next">Next &gt;&gt;</button>
		</div>
		<div class="btn-group">
			<button class="btn btn-danger" data-calendar-view="year">Year</button>
			<button class="btn btn-danger active" data-calendar-view="month">Month</button>
			<button class="btn btn-danger" data-calendar-view="week">Week</button>
			<button class="btn btn-danger" data-calendar-view="day">Day</button>
		</div>
	</div>

	<h3>March 2013</h3>
	<small>To see example with events navigate to march 2013</small>
</div>
<div id="calendar"></div>
<ul id="eventlist"></ul>
<div class="modal fade" id="events-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Event</h3>
			</div>
			<div class="modal-body" style="height: 400px">
			</div>
			<div class="modal-footer">
				<a href="#" data-dismiss="modal" class="btn">Close</a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="events-add">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form action="/form/addEvent" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4>Add Event</h4>
				</div>
				<div class="modal-body">
					{!! csrf_field() !!}
					<div class="form-group">
						<label>Event Date Start</label>
						<input type="datetime" name="start" class="form-control start" required>
					</div>
					<div class="form-group">
						<label>Event Date End</label>
						<input type="datetime" name="end" 	class="form-control end" required>
					</div>
					<div class="form-group">
						<label >Event Name</label>
						<input type="text" class="form-control" name="title" required>
					</div>
					<div class="form-group">
						<label>Event Priority</label>
						<select class="form-control" name="class" required>
							<option value="event-important">Important</option>
							<option value="event-success">Normal</option>
							<option value="event-warning">Announcement</option>
							<option value="event-info">Informative</option>
							<option value="event-inverse">News</option>
							<option value="event-special">Special</option>
						</select>
					</div>

				</div>
				<div class="modal-footer">
					<button  type="submit" class="btn btn-danger">Save</button>
					<a href="#" data-dismiss="modal" class="btn btn-default">Close</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection