<?php

namespace App\Http\Controllers;

use App\Repositories\EventRepository;

class DashboardController extends Controller
{

    /**
     * @var EventRepository
     */
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function index()
    {

        return view('dashboard.index', [
            'todayEvents' => $this->eventRepository->getTodayEvents(),
            'next5DaysEvents' => $this->eventRepository->getNextDaysEvents(5),
        ]);

    }

}
