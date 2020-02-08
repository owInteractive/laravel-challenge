<?php

namespace App\Business;

use App\Repositories\EventsRepository;

class EventsBusiness
{
    private $eventsRepository;

    public function __construct(EventsRepository $eventsRepository)
    {
        $this->eventsRepository = $eventsRepository;
    }

}