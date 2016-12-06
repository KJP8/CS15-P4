@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="css/user-home.css">
@stop

@section('content')
    @if(Auth::check())
        <h1 class="text-center">Welcome, {{ Auth::user()->name }}!</h1>
        <h4 class="text-center">You are viewing {{ $user->name }}'s Grocery List!</h4>
            
        <div>
            @if(sizeof($foods) == 0)
                <div class="text-center">
                    <h3>There are currently no foods in the Grocery List.<h3>
                </div>
            @else
                <div id='list' class="text-center">
                    @foreach($foods as $food)
                        <h3 class='truncate'>{{ $food->food_name }}</h3>
                        @if ($edit)
                            <a class='button' href='/edit/{{ $user->id }}/{{ $food->id }}'>Edit</a>
                            <a class='button' href='/delete/{{ $user->id }}/{{ $food->id }}'>Delete</a>
                        @endif
                    @endforeach
                </div>    
         @endif
        </div>
           
        @if($edit)    
            <div>
                <form method='POST' action='/user-home'>
        
                {{ csrf_field() }}
            
                    <input name='id' value='{{ $user->id }}' type='hidden'>
                    
                    <div class='form-group'>
                       <label>Food</label>
                        <input
                            type='text'
                            id='food'
                            name='food'
                        >
                       <div class='error'>{{ $errors->first('food') }}</div>
            
                        <button type="submit" class="btn btn-primary">Add Food</button>
                            
                        <div class='error'>
                        @if(count($errors) > 0)
                            Please enter a food and try again.
                        @endif
                        </div>
                    </div>
                </form>
            </div>
        @endif
    @else
        <p><a href="/login">Log In</a> or <a href="/register">Sign Up</a> now to get daily meals planned for you by an expert nutritionist!</p>
    @endif
@stop