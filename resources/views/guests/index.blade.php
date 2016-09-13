@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Guests</h1>
        @include('partials.message')
        <div class="row">
            <form action="" class="form-inline col-lg-10">
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="guests" class="btn btn-danger">Reset</a>
            </form>
            <a href="guests/create" class="btn btn-success col-lg-2">Create a Guest</a>
        </div>
        <br>
        <div class="row">
            @foreach($guests as $guest)
                <div class="card col-md-3">
                    {{--<img class="card-img-top" src="..." alt="Card image cap">--}}
                    <div class="card-block">
                        <h4 class="card-title">{{$guest->first_name}} {{$guest->last_name}}</h4>
                        <a href="guests/{{$guest->id}}" class="btn btn-success btn-sm">View</a>
                        <a href="guests/{{$guest->id}}/edit" class="btn btn-primary btn-sm">Edit</a>
                        @if ($guest->is_banned)
                            {{--                                <a href="{{route('guest.unban', ['guestId' => $guest->id])}}" class="">Un-ban</a>--}}
                        @else
                            {{--                                <a href="{{route('guest.ban', ['guestId' => $guest->id])}}" class="btn btn-danger">Ban</a>--}}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection