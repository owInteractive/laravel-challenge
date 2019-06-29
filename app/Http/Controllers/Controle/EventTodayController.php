<?php

namespace App\Http\Controllers\Controle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use App\Repository\EventRepository;

class EventTodayController extends Controller
{
    public function index()
    {	
    	$data = ['events'];
        $events = (new EventRepository)->today();
        
    	return view('controle.event.today', compact($data));
    }
    public function nextDays()
    {	
    	$data = ['events'];
        $events = (new EventRepository)->nextDays();
        
    	return view('controle.event.nextdays', compact($data));
    }

   
}
