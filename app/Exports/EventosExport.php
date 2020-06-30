<?php

namespace App\Exports;

use App\eventos;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventosExport implements FromCollection, WithHeadings
{
    
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array
    {
        return [
            'Evento',
            'Descripcion',
            'Fecha Inicio',
            'Fecha Fin',
        ];
    }
    public function collection()
    {
        $eventos = DB::table('eventos')->select('title','description','dataI','dataF')->get();
        return $eventos;
    }

    }



