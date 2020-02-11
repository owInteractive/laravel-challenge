<?php

namespace App\Http\Controllers;

use App\Business\EventsBusiness;
use App\Business\EventsExportBusiness;
use App\Business\EventsImportBusiness;
use App\Business\UserBusiness;
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

    public function store(Request $request)
    {
        $data = $request->all();
        $this->eventsBusiness->create($data);
        return redirect('events');
    }

    public function show($id)
    {
        $event = $this->eventsBusiness->find($id);
        return view('events.eventsShow')
            ->with('event', $event);
    }

    public function edit($id)
    {
        $event = $this->eventsBusiness->find($id);
        $users = $this->userBusiness->getWhereNotCurrentUser();
        return view('events.eventsEdit')
            ->with('event', $event)
            ->with('users', $users);
    }

    public function update(Request $request, $id)
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
        $csv = $this->eventsExportBusiness->exportEvents();
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'filename="' . time() . '_events.csv"');
    }

    public function import(Request $request)
    {
        $uploadedFile = $request->file('events');
        $fileData = file_get_contents($uploadedFile->getRealPath());
        $events = $this->eventsImportBusiness->extractEvents($fileData);
        $this->eventsBusiness->createEventsFromCSV($events);
        return redirect('events');
    }
}
