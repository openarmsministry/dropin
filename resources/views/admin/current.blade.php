@extends('layouts.app')

@section('content')
    <div class="container">
        @if (is_null($session))
            <h3>Start Session</h3>
           <div class="row">
               @include('partials.form-start-session')
           </div>
        @else
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
            <h3>End Session</h3>
            @include('partials.modal', ['title' => 'Are you sure?', 'id' => 'confirm-modal', 'formId' => 'end-sessions-form', 'submitText' => 'End Session Now!', 'content' => 'Please be advised that ending the session will not let you check in any more guests.', 'type' => 'danger'])
            <form id="end-sessions-form" action="{{ route('endSession', $session->id) }}" method="post">
                {{ csrf_field() }}
                <input type="button" class="form-control btn btn-danger" value="End Session" data-toggle="modal"
                       data-target="#confirm-modal">
            </form>
        @endif
    </div>
@endsection