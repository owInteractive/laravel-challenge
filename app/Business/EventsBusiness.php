<?php

namespace App\Business;

use App\Repositories\EventsRepository;
use Carbon\Carbon;

class EventsBusiness
{
    private $eventsRepository;

    public function __construct(EventsRepository $eventsRepository)
    {
        $this->eventsRepository = $eventsRepository;
    }

    public function getAll()
    {
        return $this->eventsRepository->get();
    }

    public function getTodayEvents()
    {
        $startDate = Carbon::today()->setTimeFromTimeString('00:00:00')->toDateTimeString();
        $endDate = Carbon::today()->setTimeFromTimeString('23:59:59')->toDateTimeString();
        return $this->getEventsFromDate($startDate, $endDate);
    }

    public function getFiveDayEvents()
    {
        $startDate = Carbon::today()->setTimeFromTimeString('00:00:00')->toDateTimeString();
        $endDate = Carbon::today()->addDay(5)->setTimeFromTimeString('23:59:59')->toDateTimeString();
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
        $data['start_date'] = Carbon::parse($data['start_date'])->toDateTimeString();
        $data['end_date'] = Carbon::parse($data['end_date'])->toDateTimeString();
        return $this->eventsRepository->create($data);
    }


}
