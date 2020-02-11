<?php

namespace App\Business;

use App\Repositories\EventsRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventsBusiness
{
    private $eventsRepository;

    public function __construct(EventsRepository $eventsRepository)
    {
        $this->eventsRepository = $eventsRepository;
    }

    public function getTodayEvents()
    {
        $startDate = Carbon::now()->setTimeFromTimeString('00:00:00')->toDateTimeString();
        $endDate = Carbon::now()->setTimeFromTimeString('23:59:59')->toDateTimeString();
        return $this->getEventsFromDate($startDate, $endDate);
    }

    public function getFiveDayEvents()
    {
        $startDate = Carbon::now()->setTimeFromTimeString('00:00:00')->toDateTimeString();
        $endDate = Carbon::now()->addDay(5)->setTimeFromTimeString('23:59:59')->toDateTimeString();
        return $this->getEventsFromDate($startDate, $endDate);
    }

    private function getEventsFromDate($startDate, $endDate)
    {
        return $this->eventsRepository->getEventsFromDate($startDate, $endDate);
    }

    public function getAllPaginated()
    {
        return $this->eventsRepository->paginate();
    }

    public function create(array $data)
    {
        $data = $this->formatDateToInsert($data);
        $data['user_id'] = Auth::user()->id;
        $participantsIds = $data['participants_checkbox'] ?? [];
        unset($data['participants_checkbox']);
        $event = $this->eventsRepository->create($data);
        if (!empty($participantsIds)) {
            $this->eventsRepository->syncParticipants($event, $participantsIds);
        }
        return true;
    }

    public function find($id)
    {
        return $this->eventsRepository->find($id);
    }

    public function delete($id)
    {
        try {
            $this->eventsRepository->delete($id);
            return [
                'success' => true,
                'message' => "Event {$id} deleted!",
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => "Error on deleting Event with id: {$id}",
                'exception' => $e->getMessage(),
            ];
        }
    }

    public function update($id, $data)
    {
        $event = $this->eventsRepository->find($id);
        if (!$event) {
            return 'errow';
        }

        $participantsIds = $data['participants_checkbox'] ?? [];
        unset($data['participants_checkbox']);
        $data = $this->formatDateToInsert($data);
        $this->eventsRepository->update($event, $data);
        if (!empty($participantsIds)) {
            $this->eventsRepository->syncParticipants($event, $participantsIds);
        }
        return true;
    }

    private function formatDateToInsert($data)
    {
        $data['start_date'] = Carbon::parse($data['start_date'])->toDateTimeString();
        $data['end_date'] = Carbon::parse($data['end_date'])->toDateTimeString();
        return $data;
    }

    public function exportEvents()
    {
        $allEvents = $this->eventsRepository->getEventsFromUser(Auth::user()->id);
        $rows = $this->buildRows($allEvents);
        $csv = $this->exportCSVService->exportCsv(self::CSV_HEADERS, $rows);
        return $csv;
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
