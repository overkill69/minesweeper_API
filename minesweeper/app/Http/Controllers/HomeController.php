<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
    * Show the landing page
    *
    * @return Response
    */
    public function index()
    {
        return view('home');
    }
}

