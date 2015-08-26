<?php $page = 'training'; ?>
@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<script>
	$(function(){
		$('#table-browser .file').click(function(event){
			event.preventDefault();
			var thisbtn = this;
			bootbox.prompt({
				title : "Authentication Required",
				message : "Please provide Supervisor Password",
				inputType : "password",
				callback : function(result){
					$.post("/ajax/AuthenticateSupervisor",{ password : result },function(result){
						if(typeof result == 'object' && result.status)
							window.open($(thisbtn).attr('href'),'_blank');
						else
							bootbox.alert("Authentication Failed");
					});
				}
			});

		});
	});
</script>
@endsection

@section('content')

<div class="row text-center" style="margin-bottom:30px;">
	@if($type == 'tsoc')
	<h3>TSOC - Training Station Observation Checklist</h3>
	@elseif($type == 'ops')
	<h3>OPS - Operational Procedure Sheet</h3>
	@endif
</div>
<div class="row" style="margin-bottom:30px;">
	<?php
$subfolders = explode('\\',Input::get('folder'));
$last = '';
	?>
	<ul class="breadcrumb">
		<li><a href="/training"><i class="fa fa-home"></i></a></li>
		<li><a href="?">{{ strtoupper($type) }}</a></li>
		@foreach($subfolders as $f)
		<?php $next = $last.str_ireplace('training\\'.strtolower($type).'\\', '', $f)?>
		<li><a href="?folder={{ $next }}">{{ $f }}</a></li>
		<?php $last = $next.'%2F' ?>
		@endforeach
	</ul>

	<div class="col-xs-12" style="max-height:500px;overflow-y:auto;">
		<table id="table-browser" class="table table-hover">
			@foreach($dirs as $d)
			<tr>
				<td><i class="fa fa-folder-o"></i></td>
				<td><a href="?folder={{ str_ireplace('training'.DIRECTORY_SEPARATOR.strtolower($type).DIRECTORY_SEPARATOR, '', $d) }}">{{ basename($d) }}</a></td>
				<td></td>
			</tr>
			@endforeach
			@foreach($files as $f)
			<?php
		$ft = '';
switch(pathinfo($f,PATHINFO_EXTENSION)){
	case 'pdf': 
		$ft = 'file-pdf-o';
		break;
	case 'jpg':
	case 'png':
	case 'gif':
	case 'bmp':
		$ft = 'file-image-o'; 
		break;
	case 'php':
	case 'css':
	case 'html':
	case 'js':
		$ft = 'file-code-o'; 
		break;
	case 'rar':
	case 'zip':
	case 'gz':
		$ft = 'file-archive-o'; 
		break;
	default:
		$ft = 'file-o'; 
		break;
}
			?>
			<tr>
				<td><i class="fa fa-{{ $ft }}"></i></td>
				<td><a href="/module/view?file={{$f}}" class="file" target="_blank">{{ basename($f) }}</a></td>
				<td></td>
			</tr>
			@endforeach
		</table>
	</div>


</div>
@endsection