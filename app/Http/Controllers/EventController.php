<?php


namespace App\Http\Controllers;


use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index()
    {
        $metadata = (object)[
            'app_name' => env('APP_NAME'),
            'user' => User::find(1),
            'menus' => [
                ['icon' => 'mdi-calendar-text', 'text' => 'Events'],
                ['icon' => 'mdi-account', 'text' => 'Profile']
            ],
            'events' => Event::with('user')->where('user_id', 1)->get()
        ];
        return view('pages.events.event', compact('metadata'));
    }

}