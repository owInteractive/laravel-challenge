<?php

namespace App\Business;

use App\Constants\EventsConstants;
use App\Repositories\EventsRepository;
use App\Repositories\UserRepository;
use App\Services\ImportCSVService;

class EventsImportBusiness
{
    private $eventsRepository;
    private $importCSVService;
    private $userRepository;

    public function __construct(
        EventsRepository $eventsRepository,
        ImportCSVService $importCSVService,
        UserRepository $userRepository
    )
    {
        $this->eventsRepository = $eventsRepository;
        $this->importCSVService = $importCSVService;
        $this->userRepository = $userRepository;
    }

    public function extractEvents($data)
    {
        $rows = $this->importCSVService->extractRows(
            EventsConstants::CSV_HEADERS,
            $data,
            EventsConstants::CSV_REQUIRED_VALUES
        );

        $events = [];
        foreach ($rows as $row) {
            $event = [];
            $participantsIds = [];
            foreach ($row as $key => $value) {
                if ($key === 'participants') {
                    $participants = explode("|", $value);
                    foreach ($participants as $participant) {
                        $user = $this->userRepository->getUserByEmail($participant);
                        if ($user) {
                            $participantsIds[] = $user->id;
                        }
                    }
                    $event[$key] = $participantsIds;
                    continue;
                }
                $event[$key] = $value;
            }
            $events[] = $event;
        }
        return $events;
    }

}