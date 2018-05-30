<?php

namespace App\Http\Controllers;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.home');
    }

    public function pricing()
    {
        return view('front.pricing');
    }

    public function becomeTester()
    {
        return view('front.become_tester');
    }
}
