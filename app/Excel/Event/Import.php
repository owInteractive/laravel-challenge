<?php


namespace App\Excel\Event;

use Maatwebsite\Excel\Files\ExcelFile;

class Import extends ExcelFile
{

    /**
     * Get file
     * @return string
     */
    public function getFile()
    {
        $eventsFile = request()->file('events_file');
        return $eventsFile->getPathname();
    }
}