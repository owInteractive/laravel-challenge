<?php

namespace App\Business;

use App\Constants\EventsConstants;
use App\Repositories\EventsRepository;
use App\Services\ExportCSVService;
use Illuminate\Support\Facades\Auth;

class EventsExportBusiness
{
    private $eventsRepository;
    private $exportCSVService;

    public function __construct(
        EventsRepository $eventsRepository,
        ExportCSVService $exportCSVService
    )
    {
        $this->eventsRepository = $eventsRepository;
        $this->exportCSVService = $exportCSVService;
    }

    public function exportEvents()
    {
        $allEvents = $this->eventsRepository->getEventsFromUser(Auth::user()->id);
        $rows = $this->buildRows($allEvents);
        return $this->exportCSVService->exportCsv(EventsConstants::CSV_HEADERS, $rows);
    }

    private function buildRows($events)
    {
        $rows = [];
        foreach ($events as $event) {
            $row = [
                'title' => $event->title,
                'description' => $event->description,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'participants' => '',
            ];
            if (count($event->participants) > 0) {
                $participants = [];
                foreach ($event->participants as $participant) {
                    $participants[] = $participant->email;
                }
                $row['participants'] = implode('|', $participants);
            }
            $rows[] = $row;
        }
        return $rows;
    }
}