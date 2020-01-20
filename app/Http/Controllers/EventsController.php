<?php

namespace App\Http\Controllers;

use App\Event;
use App\Exceptions\EventCreationException;
use App\Helpers\EventSerializer;
use App\Helpers\EventUnserializer;
use App\Mail\InviteParticipant;
use App\Models\User;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EventsController extends Controller
{

    public function index() {

        return view('events.index', [
            'events' => Event::getAllEvents(15),
        ]);

    }

    public function create()
    {
        return view('events.create');
    }

    public function show(int $id)
    {
        $event = Event::query()
            ->find($id);

        if (!is_a($event, Event::class)) {
            return redirect('/')
                ->withErrors('This event could not be found.');
        }

        $amIOwner = $event->amIOwner();

        return view('events.show', compact('event', 'amIOwner'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'start' => 'required|date|before_or_equal:end',
            'end' => 'required|date|after_or_equal:start'
        ]);

        $title = $request->title;
        $description = $request->description;
        $startAt = Carbon::parse($request->start)->toDateTimeString();
        $endAt = Carbon::parse($request->end)->toDateTimeString();

        /** @var Event $event */
        $event = new Event();
        $event->fill([
            'title' => $title,
            'description' => $description,
            'start_at' => $startAt,
            'end_at' => $endAt,
        ]);

        try {

            Event::createEvents([$event]);

        } catch (\InvalidArgumentException $e) {

            return redirect()
                ->back()
                ->withErrors('Failed to create your event. Please, try again.')
                ->withInput($request->only('title', 'description', 'start_at', 'end_at'));

        } catch (EventCreationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->getMessage())
                ->withInput($request->only('title', 'description', 'start_at', 'end_at'));
        }

        return redirect('/events/' . $event->id)
            ->with('success', 'Event created successfully.');

    }

    public function update(int $id, Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start'
        ]);

        $title = $request->title;
        $description = $request->description;
        $startAt = Carbon::parse($request->start);
        $endAt = Carbon::parse($request->end);

        try {

            Event::where('id', $id)
                ->whereHas('participants', function ($query) {
                    $query->where('user_id', auth()->id());
                    $query->where('owner', true);
                })
                ->update([
                    'title' => $title,
                    'description' => $description,
                    'start_at' => $startAt->toDateTimeString(),
                    'end_at' => $endAt->toDateTimeString(),
                ]);

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors('Failed to update this event. Please, try again.');
        }

        return redirect()
            ->back()
            ->with('success', 'Event updated successfully.');

    }

    public function destroy(int $id, Request $request)
    {

        $event = Event::where('id', $id)
            ->whereHas('participants', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->first();

        if (!is_a($event, Event::class)) {
            return redirect('/')
                ->withErrors('This event could not be found.');
        }

        if (!$event->amIOwner()) {
            // Authenticated user is not the owner of event, but participant. Then leave it.
            $event->participants()->detach(auth()->id());
            return redirect('/')
                ->with('success', "You leave the event '{$event->title}'.");
        }

        // Authenticated user is the owner. Detach everyone and delete.
        DB::beginTransaction();
        try {

            $event->participants()->detach();
            $event->delete();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/')
                ->withErrors('Failed to delete this event. Please, try again.');
        }

        return redirect('/')
            ->with('success', 'Your event has been deleted.');

    }

    public function showImportExportPage()
    {
        return view('events.import_export');
    }

    public function exportEvents()
    {

        $events = Event::getAllEvents();

        if (sizeof($events) <= 0) {
            return redirect('/events/import-export')
                ->withErrors('Nothing to export.');
        }

        try {

            $csv = EventSerializer::toCsv($events);

        } catch (\Exception $e) {
            return redirect('/events/import-export')
                ->withErrors('Failed to export your events. Please, try again.');
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'filename="'.time().'_ow_events.csv"');

    }

    public function importEvents(Request $request)
    {

        $this->validate($request, [
            'ow_events' => 'required|file|mimetypes:text/plain'
        ]);

        $file = $request->file('ow_events');
        $csv = file_get_contents($file->getRealPath());

        if ($csv === false) {
            return redirect('/events/import-export')
                ->withErrors('Provided file is not valid.');
        }

        try {

            $events = EventUnserializer::fromCsv($csv);

        } catch (\ParseError $e) {
            return redirect('/events/import-export')
                ->withErrors($e->getMessage());

        } catch (\League\Csv\Exception $e) {
            return redirect('/events/import-export')
                ->withErrors('The file upload was not succeded. Please, try again.');
        }

        if (sizeof($events) <= 0) {
            return redirect('/events/import-export')
                ->withErrors('There are no events to import.');
        }

        try {

            Event::createEvents($events);

        } catch (\InvalidArgumentException $e) {

            return redirect('/events/import-export')
                ->withErrors('Failed to import your events. Please, try again.');

        } catch (EventCreationException $e) {
            return redirect('/events/import-export')
                ->withErrors($e->getMessage());
        }

        return redirect()
            ->back()
            ->with('success', sizeof($events) . ' events has been imported successfully.');

    }

    public function invite(int $id, Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $event = Event::find($id);
        if (!$event->amIOwner()) {
            return redirect()
                ->back()
                ->withErrors('Only the owner of the event can invite participants.');
        }

        $email = $request->email;

        // Check if is already a participant
        $participant = $event->participants()->where('email', $email)->first();
        if (!is_null($participant)) {
            return redirect()
                ->back()
                ->withErrors($participant->name . '  is already a participant in this event.');
        }

        $payload = array(
            "iss" => "ow-calendar",
            "iat" => Carbon::now()->timestamp,
            'exp' => Carbon::now()->addDays(7)->timestamp,
            'event' => $id,
            'invited' => $email,
        );

        $token = JWT::encode($payload, env('APP_KEY'));

        Mail::to($email)->send(new InviteParticipant($event, Auth::user()->name, $token));

        return redirect()
            ->back()
            ->with('success', "A e-mail with instructions has been sent to {$email}");

    }

    public function acceptInvite(string $token)
    {
        try {

            $payload = JWT::decode($token, env('APP_KEY'), array('HS256'));

        } catch (\Exception $e) {
            return redirect('/')
                ->withErrors('This token is not valid.');
        }

        // Check if the token is for the logged person
        if (Auth::user()->email !== $payload->invited) {
            return redirect('/')
                ->withErrors('You need to be logged with the same e-mail you\'ve been invited.');
        }

        $event = Event::find($payload->event);

        // Check if the event exists
        if (!is_a($event, Event::class)) {
            return redirect('/')
                ->withErrors('The event has been deleted.');
        }

        // Check if already a participant
        if ($event->participants()->find(Auth::user()->id)) {
            return redirect('/events/' . $event->id);
        }

        /** @var User $user */
        $user = Auth::user();

        $user->events()->attach($event, ['owner' => false]);

        return redirect('/events/' . $event->id)
            ->with('success', 'You accepted the invite for this event.');

    }

}
