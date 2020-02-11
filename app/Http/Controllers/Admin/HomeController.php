<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $events = Event::paginate(5);

        return view('admin.events', [
            'events' => $events,
            'days' => 'Todos Eventos'
            ]);
    }
}
