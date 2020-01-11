<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {

        return view('dashboard.index', [
            'todayEvents' => Event::getTodayEvents(),
            'next5DaysEvents' => Event::getNextDaysEvents(5),
        ]);

    }

}
