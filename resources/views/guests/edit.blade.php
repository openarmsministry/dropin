@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.message')
        <div class="row">
            <div class="col-md-12">
                <h1>Edit the Guest</h1>
                <form action="/guests/{{$guest->id}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    @include('guests.partials.fields')
                    <img src="{{$guest->getPhotoUrl()}}" alt="">
                    <input type="submit" class="btn btn-primary form-control" value="Save">
                </form>
            </div>
        </div>
    </div>
@endsection