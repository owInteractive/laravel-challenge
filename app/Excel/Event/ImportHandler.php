<?php


namespace App\Excel\Event;

use App\Models\Event;
use Maatwebsite\Excel\Files\ImportHandler as ImportHandlerInterface;

class ImportHandler implements ImportHandlerInterface
{
    /**
     * Handle the import
     * @param $file
     * @return mixed
     */
    public function handle($file)
    {
        $events = $file->get();
        $currentUser = auth()->user();

        $eventsArray = [];
        foreach ($events as $event) {
            $eventsArray[] = [
                'user_id' => $currentUser->id,
                'title' => $event->title,
                'description' => $event->description,
                'start' => $event->start,
                'end' => $event->end,
            ];
        }

        Event::insert($eventsArray);
    }
}