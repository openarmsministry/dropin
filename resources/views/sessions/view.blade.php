@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h2>{{$session->getLocalStartString()}} Session</h2>
        <br>
        <h3>Attendance</h3>
        <div class="row">
            @if( count($guests) === 0 )
                <p>No one here yet.</p>
            @endif
            @foreach($guests as $guest)
                <div class="col-md-2">
                    @include('partials.card-simple-text', ['text' => $guest->first_name . ' ' . $guest->last_name])
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3>Clothing Needs</h3>
                @if( count($needsClothing) === 0)
                    <p>No one needs clothing yet today.</p>
                @endif
                @foreach($needsClothing as $clothingAttendance)
                    @include('partials.card-simple-text', ['text' => $clothingAttendance->guest->first_name . ' ' . $clothingAttendance->guest->last_name . ' ' . $clothingAttendance->signin_timestamp->setTimezone(config('app.local_timezone'))->format('g:i.s A')])
                @endforeach
            </div>
            <div class="col-md-6">
                <h3>OAM ID Needs</h3>
                @if( count($needsOamId) === 0)
                    <p>No one needs OAM ID yet today.</p>
                @endif
                @foreach($needsOamId as $oamIdAttendance)
                    @include('partials.card-simple-text', ['text' => $oamIdAttendance->guest->first_name . ' ' . $oamIdAttendance->guest->last_name . ' ' . $oamIdAttendance->signin_timestamp->setTimezone(config('app.local_timezone'))->format('g:i.s A')])
                @endforeach
            </div>
        </div>
    </div>
@endsection