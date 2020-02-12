<?php

namespace App\Services;

use League\Csv\Reader;

class ImportCSVService
{
    public function extractRows(array $header, string $file, array $requiredValues = [])
    {
        $reader = Reader::createFromString($file);
        $reader->setHeaderOffset(0);

        $fileHeader = $reader->getHeader();
        if ($fileHeader !== $header) {
            throw new \Exception('File headers are wrong!');
        }

        $records = $reader->getRecords();
        $csvData = [];
        foreach ($records as $record) {
            $this->isValidRecord($record, $requiredValues);
            $csvData[] = $record;
        }

        return $csvData;
    }

    private function isValidRecord(array $record, array $requiredValues)
    {
        if (empty($requiredValues)) {
            return true;
        }

        foreach ($requiredValues as $requiredValue) {
            if (empty($record[$requiredValue])) {
                throw new \Exception('There are some required values missing!');
            }
        }

        return true;
    }

}