<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;

use Response;

use App\Event;

use App\Models\User;

class EventsController extends Controller
{

    // Dá para melhorar bastante esse código, no entanto meu tempo está escasso então fiz o que pude com o pouco tempo que tinha,
    // acredito que o pior deste código seja os "amigos" que não tem relação nenhuma com os outros usuários e mesmo assim são colocados como se fossem amigos.
    // A listagem funciona bem no entanto ela poderia ser otimizada.
    // Acabei juntando a listagem com a importação e exportação para facilitar o desenvolvimento mas acho que seria melhor separá-los, ou iria depender do gosto do cliente.
    // A navegação do site funciona, mas está longe de ser boa, com certeza pode ser otimizada e muito.
    // Gostaria de ter feito mais nesse pequeno desafio, no entanto a falta de tempo me impediu. Obrigado pelo desafio, gostei muito de fazê-lo.

    public function userEvents(Request $request){

        $events = Event::all()->where('user_id', $request->user()->id);
        $filter = $request->filter;
        $eventsArray = array();

        if($events != null){
            if(isset($filter) && $filter == 'today'){
                $today_0_float = (float)date('Ymd000000');
                $today_1_float = (float)date('Ymd235959');
            }
            else if(isset($filter) && $filter == 'next_5_days'){
                $today_0_float = (float)date('Ymd000000');
                $today_1_float = (float)date('YmdHis', strtotime(date('Y-m-d 00:00:00') . ' +5 day'));
            }
            
            foreach($events as $key => $event){
                $start_datetime_float = (float)implode('', explode(':', implode('', explode('-', implode('', explode(' ', $event->start_datetime))))));
                
                $start_datetime = explode(' ', $event->start_datetime);
                $start_date = implode('/', array_reverse(explode('-', $start_datetime[0])));
                $start_time = substr($start_datetime[1], 0, 5);
                $start_datetime = $start_date . ' ' . $start_time;
    
                $events[$key]->start_datetime = $start_datetime;
    
                $end_datetime = explode(' ', $event->end_datetime);
                $end_date = implode('/', array_reverse(explode('-', $end_datetime[0])));
                $end_time = substr($end_datetime[1], 0, 5);
                $end_datetime = $end_date . ' ' . $end_time;
    
                $events[$key]->end_datetime = $end_datetime;
                
                $events[$key]->invited_friends_str = '';
                if($events[$key]->invited_friends != ''){
                    $friendsArray = array();
    
                    $events[$key]->invited_friends_str = explode('|', $events[$key]->invited_friends);
    
                    foreach($events[$key]->invited_friends_str as $value){
                        $friendsArray[] = User::find($value)->name;
                    }
    
                    $friendsArray = implode(', ', $friendsArray);

                    $events[$key]->invited_friends_str = $friendsArray;
                }
                
                if(isset($filter) && $filter == 'today' && !($start_datetime_float >= $today_0_float && $start_datetime_float <= $today_1_float)){
                    unset($events[$key]);
                }
                else if(isset($filter) && $filter == 'next_5_days' && !($start_datetime_float >= $today_0_float && $start_datetime_float <= $today_1_float)){
                    unset($events[$key]);
                }
            }
        }
        
        foreach($events as $key => $event){
            $eventsArray[] = $event;
        }

        $eventsArray = array_reverse($eventsArray);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;

        $currentEvents = array_slice($eventsArray, $perPage * ($currentPage - 1), $perPage);

        $paginator = new LengthAwarePaginator($currentEvents, count($events), $perPage, $currentPage);
        $eventsPaginated = $paginator->appends('filter', request('filter'));
        $eventsPaginated->setPath('your-events');
 
        return view('events.user_events',compact('eventsPaginated', 'filter'));
    }
 
    public function createEvent(){
        $users = User::where('id', '!=', auth()->id())->get();
        return view('events/create_event', compact('users'));
    }

    public function successfulImport(){
        return view('events.successful_import_events');
    }
 
    public function storeEvent(Request $request){
 
        $events = new Event();
        $users = User::where('id', '!=', auth()->id())->get();
        
        $status = null;
 
        $events->user_id = $request->user()->id;
        $events->title = $request->title;
        $events->description = $request->description;

        $start_datetime = explode(' ', $request->start_datetime);
        $start_date = implode('-', array_reverse(explode('/', $start_datetime[0])));
        $start_time = $start_datetime[1];
        $start_datetime = $start_date . ' ' . $start_time . ':00';

        $events->start_datetime = $start_datetime;

        $end_datetime = explode(' ', $request->end_datetime);
        $end_date = implode('-', array_reverse(explode('/', $end_datetime[0])));
        $end_time = $end_datetime[1];
        $end_datetime = $end_date . ' ' . $end_time . ':00';

        $events->end_datetime = $end_datetime;

        $friends = $request->input('friends');
        $friends = implode('|', $friends);

        $events->invited_friends = $friends;
 
        $saved = $events->save();

        if($saved){
            $status = 'success';
        }
        else{
            $status = 'error during saving in db';
        }
 
        return view('events/create_event', compact('status', 'users'));
 
    }
 
    public function exportEvent(Request $request){

        $events = Event::all()->where('user_id', $request->user()->id);
        $filter = $request->filter;
        $eventsArray = array();

        if($events != null){
            if(isset($filter) && $filter == 'today'){
                $today_0_float = (float)date('Ymd000000');
                $today_1_float = (float)date('Ymd235959');
            }
            else if(isset($filter) && $filter == 'next_5_days'){
                $today_0_float = (float)date('Ymd000000');
                $today_1_float = (float)date('YmdHis', strtotime(date('Y-m-d 00:00:00') . ' +5 day'));
            }
            
            foreach($events as $key => $event){
                $start_datetime_float = (float)implode('', explode(':', implode('', explode('-', implode('', explode(' ', $event->start_datetime))))));
                
                $start_datetime = explode(' ', $event->start_datetime);
                $start_date = implode('/', array_reverse(explode('-', $start_datetime[0])));
                $start_time = substr($start_datetime[1], 0, 5);
                $start_datetime = $start_date . ' ' . $start_time;
    
                $events[$key]->start_datetime = $start_datetime;
    
                $end_datetime = explode(' ', $event->end_datetime);
                $end_date = implode('/', array_reverse(explode('-', $end_datetime[0])));
                $end_time = substr($end_datetime[1], 0, 5);
                $end_datetime = $end_date . ' ' . $end_time;
    
                $events[$key]->end_datetime = $end_datetime;
                
                if(isset($filter) && $filter == 'today' && !($start_datetime_float >= $today_0_float && $start_datetime_float <= $today_1_float)){
                    unset($events[$key]);
                }
                else if(isset($filter) && $filter == 'next_5_days' && !($start_datetime_float >= $today_0_float && $start_datetime_float <= $today_1_float)){
                    unset($events[$key]);
                }
            }
            
            $str_generate_csv = "title;description;start_datetime;end_datetime;invited_friends;\r\n";
            foreach($events as $key => $event){
                $str_generate_csv .= $event->title . ";" . $event->description . ";" . $event->start_datetime . ";" . $event->end_datetime . ";" . $event->invited_friends . ";\r\n";
            }
        }

        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="events.csv"',
        ];
        return Response::make($str_generate_csv, 200, $headers);
 
    }

    public function importEvent(Request $request){
        $path = $request->file('csv_file')->getRealPath();
        $data_events_csv = array_map('str_getcsv', file($path));
        $events = new Event();
        $data_events = array();
        $header_csv_file = explode(';', $data_events_csv[0][0]);
        $status = null;

        if($header_csv_file[0] == 'title'
        && $header_csv_file[1] == 'description'
        && $header_csv_file[2] == 'start_datetime'
        && $header_csv_file[3] == 'end_datetime'
        && $header_csv_file[4] == 'invited_friends'){
            foreach($data_events_csv as $key => $value){
                if($key != 0){
                    $data_events_csv[$key][0] = explode(';', $value[0]);
    
                    $start_datetime = explode(' ', $data_events_csv[$key][0][2]);
                    $start_date = implode('-', array_reverse(explode('/', $start_datetime[0])));
                    $start_time = $start_datetime[1];
                    $start_datetime = $start_date . ' ' . $start_time . ':00';
    
                    $end_datetime = explode(' ', $data_events_csv[$key][0][3]);
                    $end_date = implode('-', array_reverse(explode('/', $end_datetime[0])));
                    $end_time = $end_datetime[1];
                    $end_datetime = $end_date . ' ' . $end_time . ':00';
    
                    $data_events[] = array(
                        'user_id' => $request->user()->id,
                        'title'=> $data_events_csv[$key][0][0],
                        'description'=> $data_events_csv[$key][0][1],
                        'start_datetime'=> $start_datetime,
                        'end_datetime'=> $end_datetime,
                        'invited_friends'=> $data_events_csv[$key][0][4]
                    );
                }
            }

            $saved = $events->insert($data_events);
            
            if($saved){
                $status = 'success';
            }
            else{
                $status = 'error during saving in db';
            }
        }
        else{
            $status = 'incorrect format';
        }
        
        return view('events.successful_import_events', compact('status'));
    }

    public function deleteEvent(Request $request){
        $status = null;

        $events = new Event();

        $deleted = $events->where('id', $request->id_event)->delete();

        if($deleted){
            $status = 'success';
        }
        else{
            $status = 'error during deleting in db';
        }

        return view('events.delete_event', compact('status'));
    }

    public function editEvent(Request $request){
        $users = User::where('id', '!=', auth()->id())->get();
        if($request->invited_friends != ''){
            $request->invited_friends = explode('|', $request->invited_friends);
        }
        else{
            $request->invited_friends = array();
        }
        return view('events.edit_event', compact('request', 'users'));
    }

    public function updateEvent(Request $request){
        $users = User::where('id', '!=', auth()->id())->get();
 
        $events = Event::where('id', $request->id_event)->where('user_id', $request->user()->id);
        
        $status = null;
 

        $start_datetime = explode(' ', $request->start_datetime);
        $start_date = implode('-', array_reverse(explode('/', $start_datetime[0])));
        $start_time = $start_datetime[1];
        $start_datetime = $start_date . ' ' . $start_time . ':00';

        $end_datetime = explode(' ', $request->end_datetime);
        $end_date = implode('-', array_reverse(explode('/', $end_datetime[0])));
        $end_time = $end_datetime[1];
        $end_datetime = $end_date . ' ' . $end_time . ':00';

        $friends = $request->input('friends');
        $friends = implode('|', $friends);
 
        $saved = $events->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_datetime' => $start_datetime,
            'end_datetime' => $end_datetime,
            'invited_friends' => $friends
        ]);

        
        if($request->input('friends') != null){
            $request->invited_friends = $request->input('friends');
        }
        else{
            $request->invited_friends = array();
        }

        if($saved){
            $status = 'success';
        }
        else{
            $status = 'error during updating in db';
        }
 
        return view('events.edit_event', compact('request', 'status', 'users'));
    }
}
