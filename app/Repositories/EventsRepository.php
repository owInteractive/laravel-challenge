<?php

namespace App\Repositories;

use App\Models\Events;

class EventsRepository extends BaseRepository
{
    public function __construct(Events $events)
    {
        parent::__construct($events);
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

    public function find($id)
    {
        return $this->model->with('user', 'participants')->find($id);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function update(Events $event, array $data)
    {
        return $event->update($data);
    }

    public function syncParticipants(Events $event, array $participantsIds)
    {
        return $event->participants()->sync($participantsIds);
    }
}
