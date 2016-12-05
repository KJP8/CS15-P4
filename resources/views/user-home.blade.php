@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="css/user-home.css">
@stop

@section('content')
    <h1 class="text-center">Welcome, {{ Auth::user()->name }}!</h1>
    <h3 class="text-center">You are viewing {{ $user->name }}'s Grocery List!</h3>
    <div id="info" class="text-center">
        <p>testing</p>
    </div>
        
    <div>
        @if(sizeof($foods) == 0)
            There are currently no foods in the Grocery List.
        @else
            <div id='foods' class="text-center">
                @foreach($foods as $food)
                    <h3 class='truncate'>{{ $food->food_name }}</h3>
                @endforeach
            </div>    
     @endif
    </div>
        
    <div>
        <form method='POST' action='/user-home/{id?}'>

        {{ csrf_field() }}

        <div class='form-group'>
           <label>Food</label>
            <input
                type='text'
                id='food'
                name='food'
            >
           <div class='error'>{{ $errors->first('food') }}</div>
            
            <div class='form-instructions'>
            All fields are required
            </div>

            <button type="submit" class="btn btn-primary">Add Food</button>
                
            <div class='error'>
            @if(count($errors) > 0)
                Please correct the errors above and try again.
            @endif
            </div>
        </div>

    </div>
@stop