<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now();

        $events = new Event();

        $today_events = $events->whereBetween('starts_at', [$today->startOfDay()->toDateTimeString(), $today->endOfDay()->toDateTimeString()])
            ->orWhereBetween('ends_in', [$today->startOfDay()->toDateTimeString(), $today->endOfDay()->toDateTimeString()])
            ->orderBy('starts_at')->get();

        $next_events = $events->whereBetween('starts_at', [$today->addDay()->startOfDay()->toDateTimeString(), $today->addDays(5)->endOfDay()->toDateTimeString()])
            ->orWhereBetween('ends_in', [$today->startOfDay()->toDateTimeString(), $today->endOfDay()->toDateTimeString()])
            ->orderBy('starts_at')->paginate();

        return view('dashboard', compact('today_events', 'next_events'));
    }
}
