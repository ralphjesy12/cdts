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
                    <td><b>Name : </b></td>
                    <td>{{ $user->fullname }}</td>
                </tr>
                <tr>
                    <td><b>Position : </b></td>
                    <td>{{ $user->position }}</td>
                </tr>
                <tr>
                    <td><b>Crew Service Date : </b></td>
                    <td>{{ $user->created_at->toDateTimeString() }}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <table>
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
            <table>
                <table class="table table-condensed table-bordered">
                    <thead>
                        <th>Date Taken</th>
                        <th>Name</th>
                        <th>Position</th>
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
                                    <td>{{ $a->exam()->first()->title }}</td>
                                    <td>{{ $a->score > 0.7 ? 'Passed' : 'Failed'}}</td>
                                    <td>{{ $a->score * 100 }}%</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">
                                    No Examinations Found
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            @endif
        @endsection
