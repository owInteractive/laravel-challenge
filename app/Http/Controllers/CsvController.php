<?php

namespace App\Http\Controllers;

use App\Excel\Event\Export as EventExport;
use App\Excel\Event\Import as EventImport;
use Exception;

class CsvController extends Controller
{
    public function export(EventExport $eventExport)
    {
        $eventExport->handleExport();
        return redirect()->back();
    }

    public function importForm()
    {
        return view('csv.import.form');
    }

    public function import(EventImport $eventImport)
    {
        try {
            $eventImport->handleImport();
            return redirect()->back()->with('success', 'Imported successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Error importing events. Please try again.');
        }
    }
}
