@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="css/index.css">
@stop

@section('content')
    <h1 class="text-center">Welcome to Nutritionist at Your Fingertips!</h1>
@stop

@section('body')
    <div id="info" class="container">
        <div class="row">
            <div class="col-md-4">
                <p>Nutritionist at Your Fingertips enables users to easily plan meals and keep on track toward their weight loss, gain, or maintenance goals!</p>
            </div>
        <div class="col-md-4">
            <p>By signing up for Nutritionist at Your Fingertips, you will have an assigned nutritionist who understands your goals, needs, and dietary restrictions. Your nutritionist will assign foods to your food diary each day so you don't have to worry about what to eat to reach your goals. You then get to update your food diary as you eat so your nutritionist can ensure you are staying on track.</p>
        </div>
        <div class="col-md-4">
            <p><a href="/login">Log In</a> or <a href="/register">Sign Up</a> now to get daily meals planned for you by an expert nutritionist!</p>
        </div>
        </div>
    </div>
@stop