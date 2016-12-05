<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;

use App\User;
use App\Food;

class UserHomeController extends Controller
{
    /**
    * Responds to requests to GET /user-home
    */
    
    public function show( $id = null )
    {
        $user = User::find($id);
        $foods = $user->foods;
        $edit = false;
        
        if ($id == Auth::id()) {
            $edit = true;
        };

        return view('/user-home')->with(
            [
                'user' => $user,
                'foods' => $foods,
                'edit' => $edit,
            ]
        );        
    }

     /**
    * POST
    */
    public function store(Request $request)
    {
        # Validate
        $this->validate($request, [
            'food' => 'required|min:3'
        ]);
        # If there were errors, Laravel will redirect the
        # user back to the page that submitted this request
        # The validator will tack on the form data to the request
        # so that it's possible (but not required) to pre-fill the
        # form fields with the data the user had entered
        # If there were NO errors, the script will continue...
        # Get the data from the form
        //$food_name = $request->input('food_name'); # Option 2) USE THIS ONE! :)
        
        // TODO check the food table if food already exists
        
        $food = new Food();
        $food->food_name = $request->input('food');
        $food->save();
        
        $id = $request->input('id');
        $user = User::find($id);
        $user->foods()->save($food);
        
        Session::flash('flash_message', $food->food_name.' was added.');
        return redirect('/user-home/'.$id);
    }
    
    /**
    * GET
    */
    public function edit($user_id = null, $id = null)
    {
        $user = User::find($user_id);
        $food = Food::find($id);
        return view('/edit')->with(
            [
                'food' => $food,
                'user' => $user,
            ]
        );
    }
    
    /**
    * POST
    */
    public function update(Request $request)
    {
        # Validate
        $this->validate($request, [
            'food' => 'required|min:3',
        ]);
        # Find and update book
        $food = Food::find($request->food_id);
        $food->food_name = $request->food;
        $food->save();
        
        $user_id = $request->user_id;
        
        # Finish
        Session::flash('flash_message', 'Your changes to '.$food->food_name.' were saved.');
        return redirect('/user-home/'.$user_id);
    }
    
} # end of class
