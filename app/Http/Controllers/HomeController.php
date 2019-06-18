<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = DB::table('events')
        ->select('*')
        ->where('user_id',Auth::user()->id)
        ->where('deleted_at', null)
        ->orderBy('dataInicio','asc')
        ->paginate(5);
        return view('home')->with('event',$event);
    }
}
