@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="css/index.css">
@stop

@section('content')
    <div id="info" class="container">
        <div class="row">
            @if(Auth::check())
                <h1 class="text-center">Welcome to the Grocery List App, {{ Auth::user()->name }}!</h1>
            @else
                <h1 class="text-center">Welcome to the Grocery List App!</h1>
            @endif
            <div class="col-md-4">
                <p class="text-center">The Grocery List App enables users to easily plan their next grocery trip and keep track of what they have and haven't purchased!</p>
            </div>
            <div class="col-md-4">
                <p class="text-center">By signing up for the Grocery List App, you will be able to see other users' grocery lists as well as add foods to and delete foods from your own personal grocery list. As an added bonus, you get to see the nutritional information about each food you add as you add them!</p>
            </div>
            @if(Auth::check())
                <div class="col-md-4">
                    <p class="text-center">Go to your <a class="link" href="/home">Homepage</a> to view other users' grocery lists or go to <a class="link" href="/grocery-list/{{ Auth::user()->id }}">My Grocery List</a> to view and edit your grocery list!</p>
                </div>
            @else
            <div class="col-md-4">
                <p class="text-center"><a href="/login" class="link">Log In</a> or <a href="/register" class="link">Sign Up</a> now to create your own grocery list and access other users' grocery lists!</p>
            </div>
            @endif
        </div>
    </div>
@stop

@section('body')
@stop