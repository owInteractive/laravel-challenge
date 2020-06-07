<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use Session;
use \Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Eventexport;
use App\Imports\Eventimport;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $Events = Events::latest()->paginate(5);
                return view('Events.index', compact('Events'))
                          ->with('i', (request()->input('page',1) -1)*5);
    }

     /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
     public function myevents()
        {
             if(! $session_id =auth()->id()){
                 return view('auth.login');

                }else
                {
             $session_id =auth()->id();
              $Events = Events::query();
             $Events = $Events->where('user_id', $session_id)->paginate(5);


          //   $all = Events::latest()->paginate(5);
                    return view('Events.myevents', compact('Events'))
                             ->with('i', (request()->input('page',1) -1)*5);
        }
        }


    /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
     public function today()
        {
         // $mytime = Carbon\Carbon::now();
         $mytime = date("Y-m-d");
          echo   $mytime;
              $Events = Events::query();
            $Events = Events::whereDate('start',  $mytime)
                                       ->whereDate('end', '>=', $mytime)->paginate(5);



          //   $all = Events::latest()->paginate(5);
                    return view('Events.today', compact('Events'))
                             ->with('i', (request()->input('page',1) -1)*5);
        }


 /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
     public function next()
        {
        $mytime = Carbon\Carbon::now();
        $now = date("Y-m-d");
        $mytime = $mytime->addDays(5);
        echo   $mytime;
            $Events = Events::query();
            $Events = Events::whereDate('start', '>=', $now)->whereDate('start', '<=', $mytime)->whereDate('end', '<=', $mytime)
            ->paginate(5);

          //   $all = Events::latest()->paginate(5);
                    return view('Events.today', compact('Events'))
                             ->with('i', (request()->input('page',1) -1)*5);
        }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     if(! $session_id =auth()->id()){
         return view('auth.login');

        }else
        {
        return view('Events.create');
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                    'title' => 'required',
                               'description' => 'required'
                ]);
                $session_id = Session::getId();
               Events::create([
                                          'title' =>  $request->get('title'),
                                          'description' => $request->get('description'),
                                          'user_id' => auth()->id() ,
                                          'start' => $request->get('start'),
                                          'end' =>  $request->get('end'),


                                      ]);
                       return redirect()->route('Events.index')
                                       ->with('success', 'new event created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

       $Events = Events::find($id);
               return view('Events.detail', compact('Events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
  $Events = Events::find($id);
        return view('Events.edit', compact('Events'));


            }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
  //  $request->validate([
       //    'title' => 'required',
       //    'description' => 'required'
      //   ]);

         $this->validate($request, [
             'title' => 'required',
             'description' => 'required',
             'start' => 'required',
             'end' => 'required'
         ]);
         $Events = Events::find($id);
         $Events->title = $request->get('title');
         $Events->description = $request->get('description');
         $Events ->start = $request->get('start');
         $Events ->end = $request->get('end');

         $Events->save();
         return redirect()->route('Events.index')
                         ->with('success', 'Biodata siswa updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $Events = Events::find($id);
            $Events->delete();
            return redirect()->route('Events.index')
                            ->with('success', 'Biodata siswa deleted successfully');
    }



 /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function export(){
         return Excel::download(new Eventexport , 'events.csv');
    }

/**

     * Create a new controller instance.

     *

     * @return void

     */

     public function import()
        {
            Excel::import(new Eventimport, storage_path('events.csv'));

            return redirect('/')->with('success', 'All good!');
        }

}

