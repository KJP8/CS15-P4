<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Show the application index page.
     */
    public function index()
    {
        return view('index');
    }
}
