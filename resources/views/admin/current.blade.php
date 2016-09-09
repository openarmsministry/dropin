@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Attendance</h3>
        <div class="row">
            @foreach($guests as $guest)
                <div class="col-md-2">
                    <div class="card">
                        {{--<img style="width: 100%" class="card-img-top" src="{{ $guest->getPhotoPath() }}" alt="">--}}
                        <div class="card-block">
                            <div class="card-text">{{ $guest->first_name }} {{ $guest->last_name }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <h3>End Session</h3>
        @include('partials.modal', ['title' => 'Are you sure?', 'id' => 'confirm-modal', 'formId' => 'end-sessions-form', 'submitText' => 'End Session Now!', 'content' => 'Please be advised that ending the session will not let you check in any more guests.', 'type' => 'danger'])
        <form id="end-sessions-form" action="{{ route('endSession', $session->id) }}" method="post">
            {{ csrf_field() }}
            <input type="button" class="form-control btn btn-danger" value="End Session" data-toggle="modal"
                   data-target="#confirm-modal">
        </form>
    </div>
@endsection