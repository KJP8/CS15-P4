@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="css/admin-home.css">
@stop

@section('content')
    <h1 class="text-center">Welcome, {{ Auth::user()->name }}!</h1>
    <div id="info" class="text-center">
        <p>testing</p>
    </div>
        
    @if(sizeof($users) == 0)
        There are currently no users signed up.
    @else
        <div id='users' class="text-center">
            @foreach($users as $user)
                <a href='#'><h3 class='truncate'>{{ $user->name }}</h3></a>
            @endforeach
        </div>    
    @endif
@stop