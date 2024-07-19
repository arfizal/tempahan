<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function aboutPage(){

        //
        //fetch data
        //calculate
        //logic

        return view('user.hello');

    }

    public function contactPage(){

        return view('user.contact');

    }
}