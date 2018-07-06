<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\StoreUserEventRequest;
use App\Http\Requests\UpdateUserEventRequest;
use App\Models\Event;
use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Response;

use Illuminate\Database\Eloquent\Collection;
use League\Csv\Writer;
use SplTempFileObject;

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

        switch (request()->input('when')){
            case "today":
                $events = $user->events()
                    ->whereBetween('start_datetime', [Carbon::today(), Carbon::tomorrow()])
                    ->orderBy('start_datetime');
                break;
            case "next5":
                $events = $user->events()
                    ->whereBetween('start_datetime', [Carbon::today(), Carbon::today()->addDays(5)])
                    ->orderBy('start_datetime');
                break;
            default:
                $events = $user->events()
                    ->orderBy('start_datetime');
        }

        return response()->json($events->paginate(), Response::HTTP_OK);
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

    public function export(User $user) {

        switch (request()->input('when')){
            case "today":
                $events = $user->events()
                    ->whereBetween('start_datetime', [Carbon::today(), Carbon::tomorrow()])
                    ->orderBy('start_datetime');
                break;
            case "next5":
                $events = $user->events()
                    ->whereBetween('start_datetime', [Carbon::today(), Carbon::today()->addDays(5)])
                    ->orderBy('start_datetime');
                break;
            default:
                $events = $user->events()
                    ->orderBy('start_datetime');
        }

        $events = $events->get();

        $csv = Writer::createFromFileObject(new SplTempFileObject());

        // This creates header columns in the CSV file - probably not needed in some cases.
        $csv->insertOne(['id', 'title', 'description', 'start_datetime', 'end_datetime', 'created_at']);

        foreach ($events as $event){
            $csv->insertOne([
                $event->id,
                $event->title,
                $event->description,
                $event->start_datetime,
                $event->end_datetime,
                $event->created_at,
            ]);
        }

        $csv->output( 'events.csv');

    }

    /**
     * A function to generate a CSV for a given model collection.
     *
     * @param Collection $modelCollection
     * @param $tableName
     */
    private function createCsv(Collection $modelCollection, $tableName){



    }
}
