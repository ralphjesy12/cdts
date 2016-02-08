@extends('mini')
@section('styles')
<style>
html,body{
    background: #fff;
}
</style>
@endsection
@section('content')
    @if(!empty($input['user']))
        <table>
            <tbody>
                <tr>
                    <td><b>Name</b></td>
                    <td width="50" align="center"> : </td>
                    <td>{{ $user->fullname }}</td>
                </tr>
                <tr>
                    <td><b>Position</b></td>
                    <td width="50" align="center"> : </td>
                    <td>{{ $user->position }}</td>
                </tr>
                <tr>
                    <td><b>Station</b></td>
                    <td style="width:50px;text-align:center;"> : </td>
                    <td>{{ $user->station }}</td>
                </tr>
                <tr>
                    <td><b>Crew Service Date</b></td>
                    <td width="50" align="center"> : </td>
                    <td>{{ $user->created_at->toFormattedDateString() }}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <table class="table table-condensed table-bordered">
            <thead>
                <th>Date Taken</th>
                <th>Exam Title</th>
                <th>Remarks</th>
                <th>Rating</th>
            </thead>
            <tbody>
                @if(count($assessment))
                    @foreach($assessment as $k => $a)
                        <tr>
                            <td>{{ $a->created_at->toFormattedDateString() }}</td>
                            <td>{{ $a->exam()->first()->title }}</td>
                            <td>{{ $a->score > 0.7 ? 'Passed' : 'Failed'}}</td>
                            <td>{{ $a->score * 100 }}%</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">
                            No Examinations Found
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    @else
        <table class="table table-condensed table-bordered">
            <thead>
                <th>Date Taken</th>
                <th>Name</th>
                <th>Position</th>
                <th>Station</th>
                <th>Exam Title</th>
                <th>Remarks</th>
                <th>Rating</th>
            </thead>
            <tbody>
                @if(count($assessment))
                    @foreach($assessment as $k => $a)
                        <tr>
                            <td>{{ $a->created_at->toFormattedDateString() }}</td>
                            <td>{{ $a->user()->first()->fullname }}</td>
                            <td>{{ $a->user()->first()->position }}</td>
                            <td>{{ $a->user()->first()->station }}</td>
                            <td>{{ $a->exam()->first()->title }}</td>
                            <td>{{ $a->score > 0.7 ? 'Passed' : 'Failed'}}</td>
                            <td>{{ $a->score * 100 }}%</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">
                            No Examinations Found
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    @endif

    @if(!empty($input['user']) || !empty($assessment))
        <button class="btn btn-xs btn-default hidden-print" onclick="window.print()"><i class="fa fa-fw fa-print"></i>Print Report</button>
        <a class="btn btn-xs btn-default hidden-print" href="{{ action('StaticsController@reportsview',array_merge($input,['download'=>'pdf'])) }}"><i class="fa fa-fw fa-print"></i>Save PDF</a>

    @endif
@endsection
