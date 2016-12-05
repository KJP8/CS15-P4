@extends('layouts.master')

@section('content')

    <h1>Edit {{ $food->food_name }} </h1>

    <form method='POST' action='/user-home/{{ $food->id }}'>

        {{ method_field('PUT') }}

        {{ csrf_field() }}

        <input name='food_id' value='{{ $food->id }}' type='hidden'>
        <input name='user_id' value='{{ $user->id }}' type='hidden'>

        <div class='form-group'>
            <label>Food</label>
            <input
            type='text'
            id='food'
            name='food'
            value='{{ old('food', $food->food_name) }}'
            >
            <div class='error'>{{ $errors->first('food') }}</div>
                
            <button type="submit" class="btn btn-primary">Save Changes</button>


            <div class='error'>
                @if(count($errors) > 0)
                    Please enter a food and try again.
                @endif
            </div>
        </div>
    </form>
@stop