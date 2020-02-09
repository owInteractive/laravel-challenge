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
}
