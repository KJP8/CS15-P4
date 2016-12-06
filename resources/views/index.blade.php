@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="css/index.css">
@stop

@section('content')
    @if(Auth::check())
        <h1 class="text-center">Welcome to Nutritionist at Your Fingertips, {{ Auth::user()->name }}!</h1>
    @else
        <h1 class="text-center">Welcome to Nutritionist at Your Fingertips!</h1>
    @endif
    <div id="info" class="container">
        <div class="row">
            <div class="col-md-4">
                <p>Nutritionist at Your Fingertips enables users to easily plan meals and keep on track toward their weight loss, gain, or maintenance goals!</p>
            </div>
            <div class="col-md-4">
                <p>By signing up for Nutritionist at Your Fingertips, you will have an assigned nutritionist who understands your goals, needs, and dietary restrictions. Your nutritionist will assign foods to your food diary each day so you don't have to think about what to eat to reach your goals. All you need to do is update your food diary as you eat so your nutritionist can ensure you are staying on track.</p>
            </div>
            @if(Auth::check())
                <div class="col-md-4">
                    <p>Go to your <a href="/admin-home">Homepage</a> to view other users' grocery lists or go to <a href="/user-home/{{ Auth::user()->id }}">My Grocery List</a> to view and edit your grocery list!</p>
                </div>
            @else
            <div class="col-md-4">
                <p><a href="/login">Log In</a> or <a href="/register">Sign Up</a> now to get daily meals planned for you by an expert nutritionist!</p>
            </div>
            @endif
        </div>
    </div>
@stop

@section('body')
@stop