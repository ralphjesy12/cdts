<?php $page = 'assessment'; ?>
@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
@endsection
@section('scripts')
<script src="{{ asset('js/admin.assessment.js') }}"></script>
@endsection
@section('content')
<ol class="breadcrumb">
	<li class="active">Assessment</li>
</ol>
<div class="tabbable-panel">
	<div class="tabbable-line">
		<ul class="nav nav-tabs ">
			<li>
				<a href="#tab_qa" data-toggle="tab">QA Trainings</a>
			</li>
			<li class="active">
				<a href="#tab_interactive" data-toggle="tab">Interactive</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane" id="tab_qa">
				<table class="table">
					<thead>
						<th width="150px">Exam Code</th>
						<th>Title</th>
						<th>Questions</th>
						<th>Items per Exam</th>
						<th>Maximum Attemps</th>
						<th width="100px">Action</th>
					</thead>
					<tbody>
						@foreach($exams as $e)
						@if($e['type']!="Interactive")
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
									<a href="/assessment/exams/{{ $e['code'] }}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
								</div>
							</td>
						</tr>
						@endif
						@endforeach
						<tr>
							<td colspan="6" class="text-center"><a href="#makeExams" data-toggle="modal">Add New Exam</a></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="tab-pane active" id="tab_interactive">
				<table class="table">
					<thead>
						<th width="150px">Exam Code</th>
						<th>Title</th>
						<th width="100px">Action</th>
					</thead>
					<tbody>
						@foreach($exams as $e)
						@if($e['type']=="Interactive")
						<tr>
							<td>#{{ $e['code'] }}</td>
							<td>{{ $e['title'] }}</td>
							<td>
								<div class="btn-group">
									<a href="/assessment/exams/{{ $e['code'] }}/edit" class="btn btn-default btn-xs"><i class="fa fa-folder"></i></a>
									<button class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></button>
									<a href="/assessment/exams/{{ $e['code'] }}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
								</div>
							</td>
						</tr>
						@endif
						@endforeach
						<tr>
							<td colspan="6" class="text-center"><a href="#makeInteractive" data-toggle="modal">Add New Exam</a></td>
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


<div class="modal fade" id="makeInteractive" tabindex="-1" role="dialog" aria-labelledby="makeExamsLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="makeExamsLabel">Add New Interactive</h4>
			</div>
			<div class="modal-body">
				<form id="formSaveInteractive" class="form-horizontal" action="/form/saveExamInteractive" method="POST" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<div class="form-group">
						<div class="col-sm-12">
							<input type="text" class="form-control" id="iexamtitle" name="examtitle" placeholder="Exam Title" required>
						</div>
					</div>
					<ul id="step-list" class="list-unstyled row">
						@for($i=1 ; $i<=3 ; $i++ )
										 <li class="col-xs-6" style="margin-bottom:10px;">
						<div class="media">
							<div class="media-left">
								<div>
									<input type="file" name="images[]" required>
								</div>
							</div>
							<div class="media-body text-right">
								<input type="text" name="title[]" placeholder="Step Title" class="form-control input-sm" required>
								<textarea name="desc[]" rows="2" class="form-control input-sm" placeholder="Step Description" required></textarea>
								<a href="#" class="btn-remove-step"><small>Remove this step</small></a>
							</div>
						</div>
						</li>
					@endfor
					<li class="col-xs-6" style="margin-bottom:10px;">
						<div class="alert alert-danger text-center">
							<a href="#" id="btn-add-steps">Add More Steps</a>
						</div>
					</li>
					</ul>
				</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<input type="submit" class="btn btn-primary" value="Save Changes" form="formSaveInteractive">
		</div>
	</div>
</div>
</div>
@endsection