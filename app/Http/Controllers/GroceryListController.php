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
    * Responds to requests to GET /user-home
    */
    
    public function show( $id = null )
    {
        $user = User::find($id);
        
        if(is_null($user)) {
            Session::flash('flash_message','User not found.');
            return redirect('/');
        };
        
        
        $foods = $user->foods;
        $edit = false;
        
        if ($id == Auth::id()) {
            $edit = true;
        };

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
            'food' => 'required|min:3|alpha_num'
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
        $reqFood = $request->input('food');
        $food = Food::where('food_name', '=', $reqFood)->first();
        
        if(is_null($food)) {
            $food = new Food();
            $food->food_name = $request->input('food');
            $food->save();
        };
        
        $id = $request->input('id');
        $user = User::find($id);
        
        $foods = $user->foods;
        foreach ($foods as $item) {
            if ($reqFood == $item->food_name) {
                
                Session::flash('flash_message', $food->food_name.' is already in your list.');
                return redirect('/grocery-list/'.$id);
                
            }   
        }
        
        $apiUrl = "https://api.nutritionix.com/v1_1/search/".$reqFood."?results=0%3A01&cal_min=0&cal_max=50000&fields=brand_name%2Citem_name%2Cbrand_id%2Citem_id%2Cnf_calories%2Cnf_calories_from_fat%2Cnf_total_fat%2Cnf_serving_size_qty%2Cnf_serving_size_unit&appId=292ceba0&appKey=7e655ebb06666510ffa38ccc8b95f9e0";
        $jsonStringResults = file_get_contents($apiUrl);
        
        $data = json_decode($jsonStringResults, true);

        $results = $data['hits'][0]['fields'];
        
        $user->foods()->save($food);
                
        Session::flash('flash_message', $food->food_name.' was added.');
        
        $groceryListView = 'grocery-list/'.$id;
        return redirect($groceryListView)->with($results)->with('reqFood', $reqFood);
        
    }
    
    /**
    * GET
    */
    public function edit($user_id = null, $id = null)
    {
        $food = Food::find($id);
        if(is_null($food)) {
            Session::flash('flash_message','Food not found.');
            return redirect('/grocery-list/'.$user_id);
        }
        
        $user = User::find($user_id);
        if(is_null($user)) {
            Session::flash('flash_message','User not found.');
            return redirect('/');
        };
        
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
            'food' => 'required|min:3|alpha_num',
        ]);
        # Find and update book
        $food = Food::find($request->food_id);
        $food->food_name = $request->food;
        $food->save();
        
        $user_id = $request->user_id;
        
        # Finish
        Session::flash('flash_message', 'Your changes to '.$food->food_name.' were saved.');
        return redirect('/grocery-list/'.$user_id);
    }
    
     /**
    * GET
    */
    public function delete($user_id = null, $id = null)
    {
        # Get the book to be deleted
        $food = Food::find($id);
        if(is_null($food)) {
            Session::flash('flash_message','Food not found.');
            return redirect('/grocery-list/'.$user_id);
        }
        
        $user = User::find($user_id);
        if(is_null($user)) {
            Session::flash('flash_message','User not found.');
            return redirect('/');
        };
        # First remove any tags associated with this book
        $user->foods()->detach($id);

        # Finish
        Session::flash('flash_message', $food->food_name.' was deleted.');
        return redirect('/grocery-list/'.$user_id);
    }
    
} # end of class
