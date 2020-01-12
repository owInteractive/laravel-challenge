<?php


namespace App\Helpers;


use App\Event;
use League\Csv\Reader;

class EventUnserializer
{

    /**
     * @param string $csv
     * @return Event[]
     * @throws \League\Csv\Exception|\ParseError
     */
    public static function fromCsv(string $csv): iterable
    {

        $reader = Reader::createFromString($csv);
        $reader->setHeaderOffset(0);

        if ($reader->getHeader() !== ['title', 'description', 'start_at', 'end_at']) {
            throw new \ParseError('Provided file is not valid.');
        }

        $events = array();
        foreach ($reader->getRecords() as $record) {

            if (is_null($record['title']) || is_null($record['start_at']) || is_null($record['end_at'])) {
                throw new \ParseError('Provided file is not valid.');
            }

            if (empty($record['title']) || empty($record['start_at']) || empty($record['end_at'])) {
                throw new \ParseError('Provided file is not valid.');
            }

            $event = new Event();
            foreach ($record as $attribute => $value) {
                $event->$attribute = $value;
            }
            $events[] = $event;

        }

        return $events;

    }

}