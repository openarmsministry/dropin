@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Attendance Count</th>
                <th>Clothes Count</th>
                <th>ID Count</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sessions as $session)
                <tr>
                    <td>{{$session->getLocalStartString()}}</td>
                    <td>{{$session->getAttendanceCount()}}</td>
                    <td>{{$session->getClothesNeedCount()}}</td>
                    <td>{{$session->getIdNeedCount()}}</td>
                    <td><a href='/sessions/{{$session->id}}'><i class="fa fa-eye"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$sessions->links('vendor.pagination.bootstrap-4')}}
    </div>
@endsection