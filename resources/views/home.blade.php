@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="/css/home.css">
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="text-center" id="homeContent">
            
                @if(Auth::check())
                    <h2 class="text-center">Welcome, {{ Auth::user()->name }}!</h2>
                    
                    <p class="text-center" id="directions">This app allows you to see other users' grocery lists as well as add foods to and delete foods from your own personal grocery list. As an added bonus, you get to see the nutritional information about each food you add as you add them!</p>
                    
                    <h4 class="text-center">Click on any user to view that user's grocery list</h4>
                    
                    <h4 class="text-center" id="linkText"><a class="link" href='/grocery-list/{{ Auth::user()->id }}'>Click here</a> to view your own grocery list</h4>
                    
                    <div id="userList">    
                        @if(sizeof($users) == 0)
                            There are currently no users signed up.
                        @else
                            
                            <div class="text-center">
                                @foreach($users as $user)
                                    <a href="<?php echo route('foods.show', $user->id) ?>"><h3 class='truncate'>{{ $user->name }}</h3></a>
                                @endforeach
                            </div>
                                
                        @endif
                    </div>
                        
                    @else
                        <h3 class="text-center"><a href="/login" class="link">Log In</a> or <a href="/register" class="link">Sign Up</a> now to create your own grocery list and access other users' grocery lists!</h3>
                    @endif
            </div>
        </div>
    </div>
@stop