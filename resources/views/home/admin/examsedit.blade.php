<?php $page = 'assessment'; ?>
@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
@endsection
@section('scripts')
<script src="{{ asset('js/admin.assessment.js') }}"></script>
@endsection
@section('content')
<div class="row text-center" style="margin-bottom:30px;">
	<h3>{{ strtoupper($info['title']) }}</h3>
	<div class="col-xs-6">
		<ul class="list-unstyled">
			<li><b>Code</b> {{ $info['code'] }}</li>
			<li><b>Type</b> {{ $info['type'] }}</li>
		</ul>
	</div>
	<div class="col-xs-6">
		<ul class="list-unstyled">
			<li><b>Items</b> {{ $info['items'] }}</li>
			<li><b>Attempts</b> {{ $info['attempts'] }}</li>
		</ul>
	</div>
</div>

<div class="row" style="margin-bottom:30px;">
	<table id="questionsTable" class="table">
		<thead>
			<th>#</th>
			<th>Question</th>
			<th>Choices</th>
			<th>Action</th>
		</thead>
		<tbody>'
			@if(count($questions)>0)
			@foreach($questions as $q)
			<tr>
				<td>{{ $q['id'] }}</td>
				<td>{{ $q['body'] }}</td>
				<td>{{ COUNT(JSON_DECODE($q['choices'])) }}</td>
				<td><button class="btn btn-default btn-xs btn-edit" data-info="{{ JSON_ENCODE($q) }}"><i class="fa fa-pencil"></i></button></td>
			</tr>
			@endforeach
			@else
			<tr>
				<td colspan="4" class="text-center">
					No Questions yet.
				</td>
			</tr>
			@endif
			<tr>
				<td colspan="4" class="text-center">
					<a href="#makeQuestions" data-toggle="modal">Add New Question</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>


<!-- Modal -->
<div class="modal fade" id="makeQuestions" tabindex="-1" role="dialog" aria-labelledby="makeQuestionsLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="makeQuestionsLabel">Add New Question</h4>
			</div>
			<div class="modal-body">
				<form id="formSaveQuestion" class="form-horizontal" action="/form/saveQuestion" method="POST">
					{!! csrf_field() !!}
					<input type="hidden" name="exam" value="{{ $info['id'] }}">
					<input type="hidden" name="examcode" value="{{ $info['code'] }}">
					<div class="form-group">
						<label for="examtitle" class="col-sm-2 control-label">Question</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="examtitle" rows="3" name="examtitle" placeholder="Type a question here.." required style="resize:none;"></textarea>
						</div>
					</div>
					<div class="form-group form-choices">
						<label class="col-sm-2 control-label">Answer</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="text" class="form-control" name="choices[]" required>
								<span class="input-group-btn">
									<button class="btn btn-success disabled" disabled><i class="fa fa-check"></i></button>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group form-choices">
						<label class="col-sm-2 control-label">Choice</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="text" class="form-control" name="choices[]" required>
								<span class="input-group-btn">
									<button class="btn btn-danger disabled" disabled><i class="fa fa-trash"></i></button>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group text-center">
						<a href="#" class="btn-addmorechoices">Add more choices</a>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" id="saveQuestion" form="formSaveQuestion" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
@endsection

