<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\User;
use App\Food;

class UserHomeController extends Controller
{
    /**
    * Responds to requests to GET /user-home
    */
    
    public function show( $id = null )
    {
        
        $foods = Food::with('users')->get();

foreach($foods as $food) {
    dump($food->food_name.' is associated with: ');
    foreach($food->users as $user) {
        dump($user->name);
    }
}
        $user = User::find($id);
        $foods = $user->foods;

        return view('/user-home')->with(
            [
                'user' => $user,
                'foods' => $foods,
            ]
        );        
    }

} # end of class
