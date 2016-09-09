@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.message')
        <div class="row">
            <div class="col-md-12">
                <h1>Create a New Guest</h1>
                <form action="/guests" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include('guests.partials.fields')
                    <input type="submit" class="btn btn-primary form-control" value="Save">
                </form>
            </div>
        </div>
    </div>
@endsection