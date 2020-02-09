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

    public function create(array $data)
    {
        $data['start_date'] = Carbon::parse($data['start_date'])->toDateTimeString();
        $data['end_date'] = Carbon::parse($data['end_date'])->toDateTimeString();
        return $this->eventsRepository->create($data);
    }


}
