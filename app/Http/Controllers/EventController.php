<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        /*
        if (Auth::check()) {
            return view('eventos');
        }
        echo "error, login errado";
        */
    }
}
