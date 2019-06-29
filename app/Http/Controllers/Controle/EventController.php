<?php

namespace App\Http\Controllers\Controle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use App\Repository\EventRepository;

class EventController extends Controller
{
    public function index()
    {	
    	$data = ['events', 'eventsToday', 'eventsNextDays'];
        $events = Event::orderBy('id', 'desc')->orderBy('id', 'desc')->paginate(4);
        
        $eventsToday = (new EventRepository)->today();
        $eventsNextDays = (new EventRepository)->nextDays();

    	return view('controle.event.index', compact($data));
    }

    public function create()
    {
        $data = [];
        return view('controle.event.form', compact($data));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|min:2',
            'description'   => 'required|min:2',
            'start_date'    => 'required',
            'start_time'    => 'required',
            'end_date'      => 'required',
            'end_time'      => 'required',
        ]);
        
        $event = (new EventRepository)->create($request->all());

        if (isset($event->id)) {
            return redirect()->route('controle.event.index')->with('msg', 'Registro cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('msg', 'Não foi possível salvar os dados')->with('error', true)->with('exception', $event->getMessage())->withInput();    
        }
        
    }

    public function show($id)
    {
        $data = ['event'];
        $event = Event::find($id);
        return view('controle.event.show', compact($data));
    }
    public function edit($id)
    {
        $data = ['event'];
        $event = Event::proprietario()->find($id);
        return view('controle.event.form', compact($data));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'         => 'required|min:2',
            'description'   => 'required|min:2',
            'start_date'    => 'required',
            'start_time'    => 'required',
            'end_date'      => 'required',
            'end_time'      => 'required',
        ]);
            
        try {
            
            $event = (new EventRepository)->updating($id, $request->all());

            return redirect()->route('controle.event.index')->with('msg', 'Registro atualizado com sucesso!');

        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('msg', 'Não foi possível alterar o registro')->with('error', true)->with('exception', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $event = Event::proprietario()->find($id);

            if (!isset($event->id)) {
                return redirect()->route('controle.event.index')->with('msg', 'não foi possível excluir o registro!')->with('error', true);
            }

            $event->delete();

            return redirect()->route('controle.event.index')->with('msg', 'registro excluido com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('controle.event.index')->with('msg', 'não foi possível excluir o registro!')->with('error', true);
        }
    }
}
