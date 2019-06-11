<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event as EventRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class EventController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Event::paginate(10);
        return view('admin.events.index', [
            'events' => $events
        ]);
    }

    public function eventsToday()
    {
        $currentDate = date('Y-m-d');

        $eventsToday = Event::where('date_start', '=', $currentDate)->paginate(10);

        return view('admin.events.index', [
            'eventsToday' => $eventsToday,
        ]);
    }

    public function eventsNextFiveDays()
    {
        $currentDate = date('Y-m-d');
        $nextDate = date('Y-m-d', strtotime("+5 days", strtotime($currentDate)));

        $eventsNextFiveDays = Event::whereBetween('date_start', [$currentDate, $nextDate])->paginate(10);

        return view('admin.events.index', [
            'eventsNextFiveDays' => $eventsNextFiveDays,
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

    /**
     * Delete Event
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete($id)
    {
        $event = Event::where('id', $id);
        $event->delete();

        $json = [
            'error' => false,
            'message' => 'Evento excluído com sucesso!',
            'type' => 'success'
        ];

        return response()->json($json);
    }

    /**
     * Import CSV
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import()
    {
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();

            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'title' => $value->title,
                        'description' => $value->description,
                        'date_start' => $value->date_start,
                        'date_end' => $value->date_end,
                        'created_at' => $value->created_at,
                        'updated_at' => $value->updated_at,
                    ];
                }
                if (!empty($insert)) {
                    DB::table('events')->insert($insert);
                    return back()->with([
                        'message' => 'Dados importados com sucesso!',
                        'type' => 'success'
                    ]);
                }
            }
        }

        return back();
    }

    /**
     * Export CSV
     *
     * @param $type
     * @return mixed
     */
    public function export($type)
    {
        $data = $this->dataTypeEvent($type);

        return Excel::create('events', function ($excel) use ($data) {
            $excel->sheet('events', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('csv');
    }

    private function dataTypeEvent($type_event)
    {
        $currentDate = date('Y-m-d');
        $nextDate = date('Y-m-d', strtotime("+5 days", strtotime($currentDate)));

        switch ($type_event) {
            case 'all':
                $events = Event::get();
                break;
            case 'next_five_days':
                $events = Event::whereBetween('date_start', [$currentDate, $nextDate])->get();
                break;
            case 'today':
                $events = Event::where('date_start', '=', $currentDate)->get();
                break;
        }

        return $events;
    }

    /**
     * Send Invite
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendInvite(Request $request)
    {
        $event = Event::where('id', $request->id)->first();
        Mail::to($request->guest_email)->send(new \App\Mail\Event($event));

        $json = [
            'error' => false,
            'message' => 'Convite enviado com sucesso!',
            'type' => 'success'
        ];

        return response()->json($json);
    }
}
