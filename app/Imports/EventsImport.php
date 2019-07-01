<?php

namespace App\Imports;

use App\Models\Event;
use App\Models\EventUser;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;

class EventsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $event = Event::create([
            'title' => $row[1],
            'description' => $row[2],
            'start' => $row[3],
            'end' => $row[4],
            'user_id' => Auth::id(), //importa uma lista de eventos, mas para o usuário atual.
        ]);

        EventUser::create([
            'event_id'  => $event->id,
            'user_id'   => Auth::id(),
            'accept'    => 1
        ]);
        
        return $event;
    }
}
