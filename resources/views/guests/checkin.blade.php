@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.message')
        @if($session)
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h2>Guest Checkin</h2>
                    <p>Guests Checked in so far: {{$guestCount}}</p>

                    <form action="" class="form-inline">
                        <input type="text" class="form-control " name="nickname" placeholder="Nick Name">
                        <input type="submit" class="form-control" value="Search">
                    </form>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h2 class="panel-heading">Guests with Nickname {{$nickname}}</h2>

                    <div class="row">

                        @foreach($guests as $guest)
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                @include('partials.card-image-checkboxes-action',
                                      ['imgPath' => $guest->getPhotoPath(),
                                       'actionPath' => route('attend', ['sessionId' => $session->id, 'guestId' => $guest->id]),
                                       'checkboxName' => 'services[]',
                                       'checkboxes' => $servicesArray,
                                       'buttonText' => 'Check In',
                                       ])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                Start a OpenArms Session First:
                @include('partials.form-start-session')
            </div>
        @endif
    </div>

@endsection

@section('body-script')
    <script src="/js/checkin.js"></script>
@endsection