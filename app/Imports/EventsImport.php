<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Event;

use PHPExcel; 
use PHPExcel_IOFactory;

class EventsImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Event([
           'user_id'     => $row[0],
           'title'    => $row[1], 
           'description'    => $row[2], 
           'start_date'    => date('Y-m-d H:i:s', strtotime(\PHPExcel_Style_NumberFormat::toFormattedString($row[3], 'Y-m-d H:i:s'))),
           'finish_date'    => date('Y-m-d H:i:s', strtotime(\PHPExcel_Style_NumberFormat::toFormattedString($row[4], 'Y-m-d H:i:s')))
        ]);
    }

}
