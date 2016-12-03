<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{

    /**
    * Responds to requests to GET /books
    */
    public function show()
    {
        return view('/admin-home');
    }
    
    public function index(Request $request)
    {
        $users = DB::table('users')->get();

        return view('/admin-home', ['users' => $users]);
    }

} # end of class