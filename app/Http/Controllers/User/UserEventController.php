<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\StoreUserEventRequest;
use App\Http\Requests\UpdateUserEventRequest;
use App\Models\Event;
use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Response;

class UserEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $events = $user->events;

        return response()->json($events, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserEventRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserEventRequest $request, User $user)
    {

        $data = $request->only(['title', 'description']);
        $data['user_id'] = $user->id;
        $data['start_datetime'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('start_datetime'));
        $data['end_datetime'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('end_datetime'));

        $event = Event::create($data);

        return response()->json($event, Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserEventRequest  $request
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserEventRequest $request, User $user, Event $event)
    {
        // TODO validate if user is event user

        $data = $request->only(['title', 'description']);
        if ($request->has('start_datetime'))
            $data['start_datetime'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('start_datetime'));
        if ($request->has('end_datetime'))
        $data['end_datetime'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('end_datetime'));

        $event->fill($data);
        $event->save();

        return response()->json($event, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Event $event)
    {
        // TODO validate if user is event user

        $event->delete();

        return response()->json()->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
