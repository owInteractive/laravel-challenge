<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = null;
        // $date = \request('date') != null ? new Carbon(request('date')) : Carbon::now();

        $events = new Event();

        if (\request('month') !== null && \request('year') !== null && \request('date') == null){
            $date = Carbon::createFromDate(\request('year'), \request('month'));

            $events = $events->whereBetween('starts_at', [$date->startOfMonth()->toDateString(), $date->endOfMonth()->toDateString()])
                ->orderBy('starts_at')->paginate();

            return response()->json(['data' => $events, 'dateInitial' => $date->startOfMonth()->toDateString(), 'dateFinish' => $date->endOfMonth()->toDateString()]);
        } elseif (\request('date') !== null && \request('month') == null) {
            $date = new Carbon(\request('date'));

            $events = $events->whereBetween('starts_at', [$date->startOfDay()->toDateTimeString(), $date->endOfDay()->toDateTimeString()])
                ->orWhereBetween('ends_in', [$date->startOfDay()->toDateTimeString(), $date->endOfDay()->toDateTimeString()])
                ->orderBy('starts_at')->get();
        }
        return response()->json(['data' => $events]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json(['success' => 'Event was successfully deleted!']);
    }
}
