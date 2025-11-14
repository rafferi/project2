<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()

    {
        return view('layouts.layout');
    }




public function info()

{
        return view('layouts.info');
}

public function contact()
{
        return view('layouts.contact');
}


}


