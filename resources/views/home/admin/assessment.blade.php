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
	<h1>ASSESSMENT</h1>
</div>

<div class="tabbable-panel">
	<div class="tabbable-line">
		<ul class="nav nav-tabs ">
			<li class="active">
				<a href="#tab_default_1" data-toggle="tab">QA Trainings</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_default_1">
				<table class="table">
					<thead>
						<th>Exam Code</th>
						<th>Title</th>
						<th>Questions</th>
						<th>Items per Exam</th>
						<th>Maximum Attemps</th>
						<th>Action</th>
					</thead>
					<tbody>
						@foreach($exams as $e)
						<tr>
							<td>#{{ $e['code'] }}</td>
							<td>{{ $e['title'] }}</td>
							<td>0</td>
							<td>{{ $e['items'] }}</td>
							<td>{{ $e['attempts'] }}</td>
							<td>
								<div class="btn-group">
									<a href="/assessment/exams/{{ $e['code'] }}/edit" class="btn btn-default btn-xs"><i class="fa fa-folder"></i></a>
									<button class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></button>
									<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
								</div>
							</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="6" class="text-center"><a href="#makeExams" data-toggle="modal">Add New Exam</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="makeExams" tabindex="-1" role="dialog" aria-labelledby="makeExamsLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="makeExamsLabel">Add New Exam</h4>
			</div>
			<div class="modal-body">
				<form id="formSaveExam" class="form-horizontal" action="/form/saveExam" method="POST">
					 {!! csrf_field() !!}
					<div class="form-group">
						<label for="examcode" class="col-sm-2 control-label">Code</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="examcode" name="examcode" value="{{ strtoupper(str_random(10)) }}" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="examtitle" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="examtitle" name="examtitle" placeholder="Exam Title" required>
						</div>
					</div>
					<div class="form-group">
						<label for="examitems" class="col-sm-2 control-label">Items per Exam</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="examitems" name="examitems" min="1" value="10">
						</div>
					</div>
					<div class="form-group">
						<label for="examattempts" class="col-sm-2 control-label">Max Attempts</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="examattempts" name="examattempts" min="1" value="3">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Category</label>
						<div class="col-sm-10">
							<select class="form-control" name="examtype">
								<option>Verification</option>
								<option>Training</option>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="saveExam" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
@endsection