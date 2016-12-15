<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
    * GET
    */
    public function show(Request $request)
    {
        # Get all users from users table
        $users = DB::table('users')
            ->orderBy('name', 'asc')
            ->get();
        
        # Show list of users in home view
        return view('/home', ['users' => $users]);
    }

} # end of class