<?php


namespace App\Helpers;


use App\Event;
use Illuminate\Support\Arr;
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

        $e = array();
        foreach ($events as $event) {
            $e[] = Arr::only($event->toArray(), $attributes);
        }

        $csv->insertAll($e);
        return $csv->getContent();

    }

}