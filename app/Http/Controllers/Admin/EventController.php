<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event as EventRequest;

class EventController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Event::paginate(5);
        return view('admin.events.index', [
            'events' => $events
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.events.create');
    }

    public function store(EventRequest $request)
    {
        $event = new Event();
        $event->create($request->all());

        return redirect()->route('admin.events.create')->with([
            'message' => 'Evento cadastrado com sucesso!',
            'type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $event = Event::find($id);
        return view('admin.events.edit', [
            'event' => $event
        ]);
    }

    public function update(EventRequest $request, $id)
    {
        $event = Event::where('id', $id)->first();
        $event->fill($request->all());

        if (!$event->save()) {
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.events.edit', ['events' => $event->id])->with([
            'message' => 'Evento atualizado com sucesso!',
            'type' => 'success'
        ]);
    }
}
