<?php


namespace App\Excel\Event;

use Maatwebsite\Excel\Files\NewExcelFile;

class Export extends NewExcelFile
{
    /**
     * Get file
     * @return string
     */
    public function getFilename()
    {
        return 'events';
    }
}