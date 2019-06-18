<?php

namespace App\Exports;

use App\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('events')
        ->select('titulo','descricao','dataInicio','dataFim','user_id','created_at','updated_at')
        ->where('user_id',Auth::user()->id)
        ->where('deleted_at',null)
        ->get();
    }
}
