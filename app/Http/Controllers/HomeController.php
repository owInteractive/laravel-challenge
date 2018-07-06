<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function account()
    {
        return view('account');
    }

    public function create()
    {
        return view('create');
    }

    public function edit()
    {
        return view('edit');
    }
}
