@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-3">Oh no!</h1>
                <p class="lead">Looks like you don't have permission to do this... If you think you can, please contact <a href="mailto:{{config('mail.supportAddress')}}">{{ config('mail.supportAddress') }}</a></p>
            </div>
        </div>
    </div>
</div>
@endsection