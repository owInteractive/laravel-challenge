<?php

namespace App\Helpers;

use App\Event;
use Illuminate\Support\Arr;
use League\Csv\Writer;

class EventSerializer
{

    /**
     * @param Event|iterable $events
     * @return string
     * @throws \League\Csv\CannotInsertRecord|\InvalidArgumentException
     */
    public static function toCsv($events): string
    {

        if (is_a($events, Event::class)) {
            $events = array($events);
        }

        if (!is_iterable($events)) {
            throw new \InvalidArgumentException('Argument passed must be an iterable of Event');
        }

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
