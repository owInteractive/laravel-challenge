<?php

namespace App\Http\Controllers;

use App\Event;
use App\Helpers\EventSerializer;
use App\Helpers\EventUnserializer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{

    public function index() {

        return view('events.index', [
            'events' => Event::getAllEventsPaginated(15),
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

        return view('events.show', compact('event'));
    }

    public function store(Request $request)
    {
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

            $this->persistEvents([$event]);

        } catch (\InvalidArgumentException $e) {

            return redirect()
                ->back()
                ->withErrors('Failed to create your event. Please, try again.');

        }

        return redirect('/events/' . $event->id)
            ->with('success', 'Event created successfully.');

    }

    public function update(int $id, Request $request)
    {

        $title = $request->title;
        $description = $request->description;
        $startAt = Carbon::parse($request->start)->toDateTimeString();
        $endAt = Carbon::parse($request->end)->toDateTimeString();

        Event::where('id', $id)
            ->whereHas('participants', function($query) {
                $query->where('user_id', auth()->id());
                $query->where('owner', true);
            })
            ->update([
                'title' => $title,
                'description' => $description,
                'start_at' => $startAt,
                'end_at' => $endAt,
            ]);

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
        $event->participants()->detach();
        $event->delete();

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

        if (!$request->hasFile('ow_events') || !$request->file('ow_events')->isValid()) {
            return redirect('/events/import-export')
                ->withErrors('The file upload was not succeded. Please, try again.');
        }

        $file = $request->file('ow_events');

        if ($file->getMimeType() !== 'text/plain') {
            return redirect('/events/import-export')
                ->withErrors('The provided file must be a CSV Text file.');
        }

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

            $this->persistEvents($events);

        } catch (\InvalidArgumentException $e) {

            return redirect('/events/import-export')
                ->withErrors('Failed to import your events. Please, try again.');

        }

        return redirect()
            ->back()
            ->with('success', sizeof($events) . ' events has been imported successfully.');

    }

    /**
     * @param Event[] $events
     * @throws \InvalidArgumentException
     */
    private function persistEvents(iterable $events)
    {

        foreach ($events as $event) {
            if (!is_a($event, Event::class)) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($events as $event) {

            $event->save();

            /** @var User $user */
            $user = Auth::user();
            $user->events()->attach($event, ['owner' => true]);

        }

    }

}
