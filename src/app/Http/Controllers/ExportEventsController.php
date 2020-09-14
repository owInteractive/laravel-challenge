<?php


namespace App\Http\Controllers;
use App\Exports\EventsExport;
use App\Imports\EventsImport;
use Maatwebsite\Excel\Facades\Excel;

class ExportEventsController
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExportView()
    {
        return view('import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new EventsExport, 'events.csv');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new EventsImport,request()->file('file'));

        return back();
    }
}
