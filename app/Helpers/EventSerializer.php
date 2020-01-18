<?php


namespace App\Helpers;


use App\Event;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use League\Csv\Writer;

class EventSerializer
{

    /**
     * @param Event[] $events
     * @param string[] $attributes
     * @return string
     * @throws \League\Csv\CannotInsertRecord
     */
    public static function toCsv(iterable $events): string
    {

        $attributes = ['title', 'description', 'start_at', 'end_at'];

        $csv = Writer::createFromString('');
        $csv->insertOne($attributes);

        foreach ($events as $event) {

            if (!is_a($event, Event::class)) {
                throw new \InvalidArgumentException('Argument passed must be an iterable of Event');
            }

            $csv->insertOne(Arr::only($event->toArray(), $attributes));
        }

        return $csv->getContent();

    }

}