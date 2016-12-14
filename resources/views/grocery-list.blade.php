@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="/css/grocery-list.css">
@stop

@section('content')
    <div class="container">
        <div class="row">
            @if(Auth::check())
                <div class="col-md-6" id="firstCol">
                    <h2 class="text-center">Welcome, {{ Auth::user()->name }}!</h2>
                    @if($edit)
                        <h4 class="text-center">You are viewing your Grocery List!</h4>
                    @else
                        <h4 class="text-center">You are viewing {{ $user->name }}'s Grocery List!</h4>
                        <img src="http://marketbasketnutrition.com/wp-content/uploads/2015/03/Grocery-basket.jpg" alt="groceryBasket" id="groceryBasket">
                    @endif
                    @if($edit)
                        <p class="text-center" id="directions">This tool allows you to enter foods into the field below to add them to your grocery list. As an added bonus, you get to see the nutritional information about each food you add as you add them! When you've finished shopping, you can delete all the foods from your list, or you can delete them one by one as you go.</p>
                        <div>
                            <form method='POST' action='/grocery-list' class="form">
                    
                            {{ csrf_field() }}
                        
                                <input name='id' value='{{ $user->id }}' type='hidden'>
                                
                                <div class='form-group'>
                                    <label>Food</label>
                                    <input type='text' id='food' name='food' class="form-control" placeholder="Enter food name here">                        
                                    <button type="submit" class="btn btn-success">Add Food</button>
                                    <div class='error'>{{ $errors->first('food') }}</div>
                                    <div class='error'>
                                        @if(count($errors) > 0)
                                            Please enter a food and try again.
                                        @endif
                                    </div>
                                </div>
                            </form>
                            @if(Session::has('item_id'))
                                <div id="nutritionInfo">
                                    <h2>Nutritional Information</h2>
                                    <div id="nutritionOutput">
                                        <p id="foodOutput">{{ Session::get('reqFood') }}</p>
                                        <ul>
                                            <li id="cal">Total Calories: {{ Session::get('nf_calories') }}</li>
                                            <li id="fatCal">Calories from Fat: {{ Session::get('nf_calories_from_fat') }}</li>
                                            <li id="fat">Total Fat: {{ Session::get('nf_total_fat') }}</li>
                                            <li id="serving">Serving Size: {{ Session::get('nf_serving_size_qty') }} {{ Session::get('nf_serving_size_unit') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-md-6" id="firstCol">
                    @if($edit)
                        <h2 class="text-center">Your Grocery List</h2>
                    @else
                        <h2 class="text-center">{{ $user->name }}'s Grocery List</h2>
                    @endif
                    @if(sizeof($foods) == 0)
                        <div class="text-center">
                            <h3 id="warning">There are currently no foods in the Grocery List.<h3>
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
            @else
                <h3 class="text-center"><a href="/login" class="link">Log In</a> or <a href="/register" class="link">Sign Up</a> now to create your own grocery list and access other users' grocery lists!</h3>
            @endif
        </div>
    </div>
@stop