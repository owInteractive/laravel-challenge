<?php

namespace App\Http\Controllers;

use App\Business\EventsBusiness;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    private $eventsBusiness;

    public function __construct(EventsBusiness $eventsBusiness)
    {
        $this->eventsBusiness = $eventsBusiness;
    }

    public function index()
    {
        $todayEvents = $this->eventsBusiness->getTodayEvents();
        $fiveDayEvents = $this->eventsBusiness->getFiveDayEvents();
        $paginatedEvents = $this->eventsBusiness->getAllPaginated();
        return view('events.eventsView')
            ->with('fiveDayEvents', $fiveDayEvents)
            ->with('todayEvents', $todayEvents)
            ->with('paginatedEvents', $paginatedEvents);
    }

    public function create()
    {
        return view('events.eventsForm');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->eventsBusiness->create($data);
        return redirect('events');
    }

    public function show($id)
    {
        $event = $this->eventsBusiness->find($id);
        return view('events.eventsShow')
            ->with('creator', $event)
            ->with('participants', $event)
            ->with('event', $event);
    }

    public function edit(Events $events)
    {
        //
    }

    public function update(Request $request, Events $events)
    {
        //
    }

    public function destroy($id)
    {
        $return = $this->eventsBusiness->delete($id);
        if ($return['success']) {
            return redirect('events');
        }
        return redirect('events')->withErrors(['errors', $return['message']]);
    }
}
