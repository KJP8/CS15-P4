@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="/css/edit.css">
@stop

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="text-center">Edit "{{ $food->food_name }}" </h2>
        
            <form method='POST' action='/grocery-list/{{ $food->id }}' class="form">
        
                {{ method_field('PUT') }}
        
                {{ csrf_field() }}
        
                <input name='food_id' value='{{ $food->id }}' type='hidden'>
                <input name='user_id' value='{{ $user->id }}' type='hidden'>
        
                <div class='form-group'>
                    <label>Food</label>
                    <input type='text' id='food' name='food' class="form-control" value='{{ old('food', $food->food_name) }}'>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                        
                    <div class='error'>{{ $errors->first('food') }}</div>
                    <div class='error'>
                        @if(count($errors) > 0)
                            Please enter a food and try again.
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop