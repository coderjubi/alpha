<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function about(){
        return view('about');
    }
    function contact(){
        return view('contact');
    }
    function welcome(){
        return view('welcome');
    }
}
