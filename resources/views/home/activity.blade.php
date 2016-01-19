<?php $page = 'activity'; ?>
@extends('app')
@section('styles')
<link href="{{ asset('css/dash.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<ol class="breadcrumb">
	<li class="active">Activities</li>
</ol>
<table class="table table-hover table-striped">
	<tbody>

		@foreach($activities as $a)
		<?php
$icon = 'fa-clock-o';
switch($a->name){
	case 'login' : $icon = 'fa-user'; break;
	case 'exam' : $icon = 'fa-bolt'; break;
	default: $icon = 'fa-clock-o';  break;
}
		?>
		<tr>
			<td class="text-center"><i class="fa fa-fw {{ $icon }}"></i></td>
			<td>{{ $user['id'] == $a->user ? 'You ' : $a->getUser()->first()->fullname  }} {{ trim($a->description) }} {{ $a->created_at->diffForHumans() }}</td>
			<td class="text-right">{{ $a->created_at->toDayDateTimeString() }}</td>
		</tr>
		@endforeach
	</tbody>

</table>

@if($activities->currentPage()==1 && !$activities->hasMorePages())
<ul class="pagination">
	<li class="disabled"><span>«</span></li> 
	<li class="active"><span>1</span></li>
	<li class="disabled"><span>»</span></li>
</ul>
@else
{!! $activities->render() !!}
@endif
@endsection