<?php

namespace App\Http\Controllers\Controle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use App\Repository\EventRepository;

class DashboardController extends Controller
{
    public function index()
    {	
    	$data = ['events', 'eventsToday', 'eventsNextDays'];
        $events = Event::orderBy('id', 'desc');
        
        $eventsToday = (new EventRepository)->today();
        $eventsNextDays = (new EventRepository)->nextDays();

    	return view('controle.dashboard.index', compact($data));
    }

}
