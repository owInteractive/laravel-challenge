<?php

namespace App\Repositories;

use App\Models\Events;

class EventsRepository extends BaseRepository
{
    public function __construct(Events $events)
    {
        parent::__construct($events);
    }

    public function get()
    {
        return $this->model->get();
    }

    public function getEventsFromDate($startDate, $endDate)
    {
        return $this->model->whereBetween('start_date', [$startDate, $endDate])
            ->orderBy('start_date')
            ->get();
    }

    public function paginate()
    {
        return $this->model->paginate(10);
    }
}
