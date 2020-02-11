<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_user');
    }

    public function formatDate($date)
    {
        if (is_null($date)) {
            return null;
        }

        try {
            return Carbon::parse($date)->format('d-m-Y H:i:s');
        } catch (\Exception $ex) {
            return null;
        }
    }
}
