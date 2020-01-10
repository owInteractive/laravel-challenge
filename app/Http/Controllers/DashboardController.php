<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {

        $todayDate = Carbon::today()->toDateString();
        $todayEvents = Event::query()
            ->where('user_id', auth()->id())
            ->whereDate('start_at', '=', $todayDate)
            ->get();

        $next5DaysDate = Carbon::today()->addDay(5)->toDateString();
        $next5DaysEvents = Event::query()
            ->where('user_id', auth()->id())
            ->whereDate('start_at', '>', $todayDate)
            ->whereDate('start_at', '<=', $next5DaysDate)
            ->get();

        return view('dashboard.index', compact(
            'todayEvents',
            'next5DaysEvents'));

    }

}
