<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EventRepository;
use App\Http\Requests\EventRequest;
use App\Event;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailInvite;


class EventController extends Controller
{

 	private $eventRepository;

  public function __construct(EventRepository $eventRepository)
  {
      $this->middleware('auth');
      $this->eventRepository = $eventRepository;
  }

  public function index($flag)
  {
      switch ($flag) {
          case Event::FILTER_EVENTS_ALL:
              $events = $this->eventRepository->findAll();
              break;
          case Event::FILTER_EVENTS_TODAY:
             $events = $this->eventRepository->getEventsToday();
              break;
          case Event::FILTER_EVENTS_NEXT_5_DAYS:
             $events = $this->eventRepository->getEventsNext5Days();
              break;
    }

    return view('event.index', compact('events', 'flag'));
  }

  public function create()
  {
      return view('event.create');
  }

  public function store(EventRequest $request)
  {
    $dateStart = $request->input('ts_start');
    $timeStart = $request->input('time_start');
    $tsStart   = $dateStart." ".$timeStart;

    $dateEnd = $request->input('ts_end');
    $timeEnd = $request->input('time_end');
    $tsEnd   = $dateEnd." ".$timeEnd;

    $dadosEvent = array(
        "title"        => $request->input('title'),
        "description"  => $request->input('description'),
        "ts_start"     => $tsStart,
        "ts_end"       => $tsEnd
    );

     try {
       $insert = $this->eventRepository->create($dadosEvent);
       if ($insert) {
            return redirect()
                    ->route('event.index', Event::FILTER_EVENTS_ALL)
                    ->with('success','Evento cadastrado com sucesso');
        }
     }catch (Exception $e){
         $e->getMessage();
     }

  }

  public function edit($id)
  {
     $event = $this->eventRepository->findById($id);
     $timeStart       = date('H:i:s', strtotime(str_replace('-','/', $event->ts_start)));
     $timeEnd         = date('H:i:s', strtotime(str_replace('-','/', $event->ts_end)));
     $event->ts_start = date('Y-m-d', strtotime(str_replace('-','/', $event->ts_start)));
     $event->ts_end   = date('Y-m-d', strtotime(str_replace('-','/', $event->ts_end)));

     return view('event.edit', compact('event','timeStart','timeEnd'));
  }

  public function update(Request $request, $id)
  {
    $event = $this->eventRepository->findById($id);

    $dateStart = $request->input('ts_start');
    $timeStart = $request->input('time_start');
    $tsStart   = $dateStart." ".$timeStart;

    $dateEnd = $request->input('ts_end');
    $timeEnd = $request->input('time_end');
    $tsEnd   = $dateEnd." ".$timeEnd;

    $dadosEvent = array(
        "title"        => $request->input('title'),
        "description"  => $request->input('description'),
        "ts_start"     => $tsStart,
        "ts_end"       => $tsEnd
    );

    try {
      if ( $event->update($dadosEvent)){
        return redirect()
                ->route('event.index', Event::FILTER_EVENTS_ALL)
                ->with('success','Evento atualizado com sucesso');
      }
    }catch (Exception $e){
        $e->getMessage();
    }
  }

  public function export($flag)
  {

    switch ($flag) {
        case Event::FILTER_EVENTS_ALL:
            $events = $this->eventRepository->findAll();
            break;
        case Event::FILTER_EVENTS_TODAY:
           $events = $this->eventRepository->getEventsToday();
            break;
        case Event::FILTER_EVENTS_NEXT_5_DAYS:
           $events = $this->eventRepository->getEventsNext5Days();
            break;
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $saida = fopen('php://output', 'w');
    fputcsv($saida, array('ID', 'Titulo', 'Descrição', 'Inicio', 'Termino'));

    foreach( $events as $value ){
      fputcsv($saida, array($value->id,
                            $value->description,
                            $value->title,
                            $value->ts_start,
                            $value->ts_end));
    }

  }

  public function import()
  {
    return view('event.import');
  }

  public function importData(Request $request)
  {

  if ($request->hasFile('fileCsv') && $request->file('fileCsv')->isValid() ){
     $file = fopen($request->file('fileCsv'), 'r');
     $i=0;
     while (($data = fgetcsv($file, null, ',')) !== false) {
        if ($i != 0){ //ignorar cabeçalho
            $title       = $data[1];
            $description = $data[2];
            $ts_start    = $data[3];
            $ts_end      = $data[4];
            $dadosEvent = array(
                "title"        => $title,
                "description"  => $description,
                "ts_start"     => $ts_start,
                "ts_end"       => $ts_end
            );
          $this->eventRepository->create($dadosEvent);
        }
        $i=$i+1;
    }

    return redirect()
            ->route('event.index', Event::FILTER_EVENTS_ALL)
            ->with('success','Evento(s) importado com sucesso');
  }

}

public function inviteFriend($event)
{
  $event = $this->eventRepository->findById($event);
  return view('event.invite', compact('event'));
}

public function sendInvite(Request $request)
{

  $nome    = $request->input('nome');
  $email    = $request->input('email');
  $id_event = $request->input('event');

  if ($email ){
    $event = $this->eventRepository->findById($id_event);
    Mail::to($email)->send(new SendMailInvite($event, $nome));
    return redirect()
            ->route('event.index', Event::FILTER_EVENTS_ALL)
            ->with('success','Convite enviado com sucesso');
  }

}




}
