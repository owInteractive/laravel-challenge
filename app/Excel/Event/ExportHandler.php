<?php


namespace App\Excel\Event;


use App\Models\Event;
use Maatwebsite\Excel\Files\ExportHandler as ExportHandlerInterface;

class ExportHandler implements ExportHandlerInterface
{
    /**
     * Handle the export
     * @param $export
     * @return mixed
     */
    public function handle($export)
    {
        $events = Event::currentUser()->eventsByFilter(
            request()->get('filter')
        )->get();

        return $export->sheet('events', function ($sheet) use($events) {
            $eventsArray = [];
            foreach ($events as $event) {
                $eventsArray[] = [
                    'title' => $event->title,
                    'description' => $event->description,
                    'start' => $event->start,
                    'end' => $event->end,
                ];
            }
            $sheet->fromArray($eventsArray);
        })->download('csv');
    }
}