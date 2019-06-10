<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date_start',
        'date_end',
    ];

    public static function convertStringToDate($param)
    {
        if (empty($param)) {
            return null;
        }

        list($year, $month, $day) = explode('-', $param);
        return (new \DateTime($day . '-' . $month . '-' . $year))->format('d/m/Y');
    }
}
