@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="css/admin-home.css">
@stop

@section('content')
    @if(Auth::check())
        <h1 class="text-center">Welcome, {{ Auth::user()->name }}!</h1>
        <h4 class="text-center">Click on any user to view that user's grocery list</h4>
            
        @if(sizeof($users) == 0)
            There are currently no users signed up.
        @else
            <div id='list' class="text-center">
                @foreach($users as $user)
                    <a href="<?php echo route('users.show', $user->id) ?>"><h3 class='truncate'>{{ $user->name }}</h3></a>
                @endforeach
            </div>    
        @endif
    @else
        <p><a href="/login">Log In</a> or <a href="/register">Sign Up</a> now to get daily meals planned for you by an expert nutritionist!</p>
    @endif
@stop