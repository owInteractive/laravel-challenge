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

        $events = Events::where('user_id', 1)->get();

        return view('events', compact($events));

    }

    public function create() {

        return view ('events');
    }
}
