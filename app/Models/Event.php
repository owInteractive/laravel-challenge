<?php

namespace App\Models;
use Carbon\Carbon;
use Exception;

use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    protected $fillable = [
        'title', 'description','start','end','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function confirmations()
    {
        return $this->hasMany(Confirmation::class);
    }

    /**
     * Today events
     */
    public function scopeToday($query)
    {
        return $query->where('start', Carbon::today()->toDateString());
    }

    /**
     * Upcoming events in X days
     */
    public function scopeNextDays($query, $days)
    {
        return $query->where('start', '>=', Carbon::today()->toDateString());
    }

    /**
     * Events by creator
     */
    public function scopeCreator($query, $creator)
    {   
        try{
            return $query->where('user_id', '>=', $creator->id);
        } catch(Exception $e) {
            throw new Exception('Creator must be an instance of App\Models\User');
        }
        
    }
}
