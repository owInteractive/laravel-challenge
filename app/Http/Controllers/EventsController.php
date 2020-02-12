<?php

namespace App\Http\Controllers;

use App\Business\EventsBusiness;
use App\Business\EventsExportBusiness;
use App\Business\EventsImportBusiness;
use App\Business\UserBusiness;
use App\Http\Requests\EventFormRequest;
use App\Http\Requests\EventImportFormRequest;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    private $eventsBusiness;
    private $userBusiness;
    private $eventsExportBusiness;
    private $eventsImportBusiness;

    public function __construct(
        EventsBusiness $eventsBusiness,
        UserBusiness $userBusiness,
        EventsExportBusiness $eventsExportBusiness,
        EventsImportBusiness $eventsImportBusiness
    )
    {
        $this->eventsBusiness = $eventsBusiness;
        $this->userBusiness = $userBusiness;
        $this->eventsExportBusiness = $eventsExportBusiness;
        $this->eventsImportBusiness = $eventsImportBusiness;
    }

    public function index()
    {
        $todayEvents = $this->eventsBusiness->getTodayEvents();
        $fiveDayEvents = $this->eventsBusiness->getFiveDayEvents();
        $paginatedEvents = $this->eventsBusiness->getAllPaginated();
        return view('events.eventsView')
            ->with('fiveDayEvents', $fiveDayEvents)
            ->with('todayEvents', $todayEvents)
            ->with('paginatedEvents', $paginatedEvents);
    }

    public function create()
    {
        $users = $this->userBusiness->getWhereNotCurrentUser();
        return view('events.eventsForm')
            ->with('users', $users);
    }

    public function store(EventFormRequest $request)
    {
        $data = $request->all();
        $this->eventsBusiness->create($data);
        return redirect('events');
    }

    public function show($id)
    {
        $event = $this->eventsBusiness->find($id);
        if ($event) {
            return view('events.eventsShow')
                ->with('event', $event);
        }
        return redirect('events')->withErrors(['Couldn\'t find the Event!']);
    }

    public function edit($id)
    {
        $event = $this->eventsBusiness->find($id);
        if ($event) {
            $users = $this->userBusiness->getWhereNotCurrentUser();
            return view('events.eventsEdit')
                ->with('event', $event)
                ->with('users', $users);
        }
        return redirect('events')->withErrors(['Couldn\'t find the Event!']);
    }

    public function update(EventFormRequest $request, $id)
    {
        $this->eventsBusiness->update($id, $request->all());
        return redirect('events');
    }

    public function destroy($id)
    {
        $return = $this->eventsBusiness->delete($id);
        if ($return['success']) {
            return redirect('events');
        }
        return redirect('events')->withErrors(['errors', $return['message']]);
    }

    public function export()
    {
        try {
            $csv = $this->eventsExportBusiness->exportEvents();
            return response($csv)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'filename="' . time() . '_events.csv"');
        } catch (\Exception $ex) {
            return redirect('events')->withErrors([
                'Problem while exporting CSV',
                $ex->getMessage()
            ]);
        }
    }

    public function import(EventImportFormRequest $request)
    {
        try {
            $uploadedFile = $request->file('events');
            $fileData = file_get_contents($uploadedFile->getRealPath());
            $events = $this->eventsImportBusiness->extractEvents($fileData);
            $this->eventsBusiness->createEventsFromCSV($events);
            return redirect('events');
        } catch (\Exception $ex) {
            return redirect('events')->withErrors([
                'Problem while importing CSV',
                $ex->getMessage()
            ]);
        }
    }
}
