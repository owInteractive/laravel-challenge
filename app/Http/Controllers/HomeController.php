<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function register()
    {
        return view('register');
    }

    public function reset()
    {
        return view('reset');
    }

    public function forgot()
    {
        return view('email');
    }

    public function account()
    {
        return view('account');
    }

    public function create()
    {
        return view('create');
    }
}
