<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;

use App\User;
use App\Food;

class GroceryListController extends Controller
{
    /**
    * GET
    */ 
    public function show( $id = null )
    {
        # Get the id of the user whose list is being viewed
        $user = User::find($id);
        
        if(is_null($user)) {
            Session::flash('flash_message','User not found');
            return redirect('/');
        };
        
        # Get all foods associated with the user's list being viewed
        $foods = $user->foods;
        
        # If logged in user is viewing someone else's list, then he cannot edit that user's list
        $edit = false;
        
        # If logged in user is viewing his own list, then he can edit the list
        if ($id == Auth::id()) {
            $edit = true;
        };
        
        # Provide the view with the user, food, and edit capabilities information
        return view('/grocery-list')->with(
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
            'food' => 'required|min:3|regex:/^[\pL\s]+$/u'
        ]);
        # If there were errors, Laravel will redirect the
        # user back to the page that submitted this request
        # The validator will tack on the form data to the request
        # so that it's possible (but not required) to pre-fill the
        # form fields with the data the user had entered
        # If there were NO errors, the script will continue...
        
        # Get the data from the form
        $reqFood = $request->input('food');
        $food = Food::where('food_name', '=', $reqFood)->first();
        
        # Save food
        if(is_null($food)) {
            $food = new Food();
            $food->food_name = $request->input('food');
            $food->save();
        };
        
        $id = $request->input('id');
        $user = User::find($id);
        
        # If food already exists in the user's list, do not save the food and alert the user
        $foods = $user->foods;
        foreach ($foods as $item) {
            if ($reqFood == $item->food_name) {
                
                Session::flash('flash_message', '"'.$food->food_name.'" is already in your list');
                return redirect('/grocery-list/'.$id);
                
            }   
        }
        
        # Replace the spaces in the user's input with correct format to call the API
        $noSpacesFood = preg_replace('/\s+/', '%20', $reqFood);
        
        # Submit user's formatted input to the Nutritionix API
        $apiUrl = "https://api.nutritionix.com/v1_1/search/".$noSpacesFood."?results=0%3A01&cal_min=0&cal_max=50000&fields=brand_name%2Citem_name%2Cbrand_id%2Citem_id%2Cnf_calories%2Cnf_calories_from_fat%2Cnf_total_fat%2Cnf_serving_size_qty%2Cnf_serving_size_unit&appId=292ceba0&appKey=7e655ebb06666510ffa38ccc8b95f9e0";
        $jsonStringResults = file_get_contents($apiUrl);
        
        $data = json_decode($jsonStringResults, true);
        
        # If the API gets results, add the food to the user's list and present the user with the nutrition information
        if ($data['total_hits'] > 0) {
            $results = $data['hits'][0]['fields'];
            $user->foods()->save($food);
            Session::flash('flash_message', '"'.$food->food_name.'" was added to your list');
            return redirect('grocery-list/'.$id)->with($results)->with('reqFood', $reqFood);
        }
        # If the API does not get results, alert the user
        else {
            Session::flash('flash_message', 'No results found for "'.$food->food_name.'". Please enter an actual food name');
            return redirect('grocery-list/'.$id);
        }
        
        
    }
    
    /**
    * GET
    */
    public function edit($user_id = null, $id = null)
    {
        # Get the food to be edited
        $food = Food::find($id);
        if(is_null($food)) {
            Session::flash('flash_message','Food not found');
            return redirect('/grocery-list/'.$user_id);
        }
        
        # Get the user whose food is to be edited
        $user = User::find($user_id);
        if(is_null($user)) {
            Session::flash('flash_message','User not found');
            return redirect('/');
        };
        
        # Provide the view with the user and food information
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
            'food' => 'required|min:3|regex:/^[\pL\s]+$/u',
        ]);
        
        # Find and update food
        $food = Food::find($request->food_id);
        $food->food_name = $request->food;
        $food->save();
        
        $user_id = $request->user_id;
        
        # Finish
        Session::flash('flash_message', 'Your changes to "'.$food->food_name.'" were saved');
        return redirect('/grocery-list/'.$user_id);
    }
    
     /**
    * GET
    */
    public function delete($user_id = null, $id = null)
    {
        # Get the food to be deleted
        $food = Food::find($id);
        if(is_null($food)) {
            Session::flash('flash_message','Food not found');
            return redirect('/grocery-list/'.$user_id);
        }
        
        # Get the user the food will be deleted from
        $user = User::find($user_id);
        if(is_null($user)) {
            Session::flash('flash_message','User not found');
            return redirect('/');
        };
        
        # Remove the chosen food from the user's list
        $user->foods()->detach($id);

        # Finish
        Session::flash('flash_message', '"'.$food->food_name.'" was removed from your list');
        return redirect('/grocery-list/'.$user_id);
    }
    
     /**
    * GET
    */
    public function deleteAll($user_id = null)
    {
        # Get the user the foods will be deleted from
        $user = User::find($user_id);
        if(is_null($user)) {
            Session::flash('flash_message','User not found');
            return redirect('/');
        };
        
        # Remove all foods from the user's list
        User::find($user_id)->foods()->detach();
        
        # Finish
        Session::flash('flash_message', 'All foods have been removed from your list');
        return redirect('/grocery-list/'.$user_id);
    }
    
} # end of class
