<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function __construct() {

        $this->middleware('auth');

    }

    public function index() {

        

        return view('events');

    }
}
