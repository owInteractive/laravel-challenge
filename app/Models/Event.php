<?php

namespace App\Models;

use App\Traits\Blameable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Blameable;

    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'user_id'
    ];

    //protected $dates = ['start', 'end'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the events of the day
     */
    public function scopeToday($query)
    {
        $today = Carbon::now();

        return $query->whereBetween('start', [$today->startOfDay()->toDateTimeString(), $today->endOfDay()->toDateTimeString()])
            ->orWhereBetween('end', [$today->startOfDay()->toDateTimeString(), $today->endOfDay()->toDateTimeString()])
            ->orderBy('start');
    }

    /**
     * Returns events from next 5 days
     */
    public function scopeNext($query)
    {
        $today = Carbon::now();

        return $query->whereBetween(
            'start',
            [$today->addDay()->startOfDay()->toDateTimeString(), $today->addDays(5)->endOfDay()->toDateTimeString()]
        )
            ->orderBy('start');
    }


    public static function insertData($data)
    {

        DB::table('users')->insert($data);

    }
}
