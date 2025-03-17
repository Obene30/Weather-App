<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function settings()
    {
        return view('contact');
    }
}
