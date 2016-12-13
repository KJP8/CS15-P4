<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
    * Responds to requests to GET /admin-home
    */
    
    public function show(Request $request)
    {
        $users = DB::table('users')
            ->orderBy('name', 'asc')
            ->get();
            
        return view('/home', ['users' => $users]);
    }

} # end of class