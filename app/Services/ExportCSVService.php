<?php

namespace App\Services;

use League\Csv\Writer;

class ExportCSVService
{
    public function exportCsv(array $headers, array $rows)
    {
        $csv = Writer::createFromString();
        $csv->insertOne($headers);
        if (!empty($rows)) {
            $csv->insertAll($rows);
        }
        return $csv->getContent();
    }
}