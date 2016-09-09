@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.message')
        <h1>Guest Information</h1>
        <p>Full Name: {{$guest->first_name}} {{$guest->last_name}}</p>
        <p>Nick Name: {{$guest->nick_name}}</p>
        <p>Official Name: {{$guest->official_name}}</p>
        <p>Birth Date: {{$guest->birth_date ? $guest->birth_date->format('M d Y') : null}}</p>
        <p>SSN: {{$guest->ssn}}</p>
        <div class="row">
            <img class="col-md-3" src="{{$guest->getPhotoPath()}}" alt="">
        </div>

        <h2>Attendance</h2>
        <ul>
        @foreach($attendances as $attendance)
            <li>{{$attendance->signin_timestamp->setTimezone(config('app.local_timezone'))->format('D M d Y')}}</li>
        @endforeach
        </ul>

        <h2>Delete User</h2>
        <form action="/guests/{{$guest->id}}" method="post">
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <p>If you delete the user, it will remove all their attendances record as well.</p>
            <input class="btn btn-danger" type="submit" value="Delete Guest">
        </form>
    </div>
@endsection