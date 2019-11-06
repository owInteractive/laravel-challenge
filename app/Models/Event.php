<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'start_at', 'end_at',
    ];

    /**
     * Cast dates
     */
    protected $dates = [
        'start_at','end_at'
    ];

    /**
     * Get the event's owner
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Get the event's attendees
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attendees()
    {
        return $this->belongsToMany(User::class,'registrations')->using(Registration::class)->withTimestamps();
    }

    /**
     * Boot
     */
    public static function boot() {

        parent::boot();
    
        static::creating(function($event) {
            $event->user_id = auth()->user()->id;
        });  
    }

    /**
     * Get short description
     */
    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description, 150, '...');
    }

     /**
     * Today events
     */
    public function scopeToday($query)
    {
        return $query->where('start_at', Carbon::today()->toDateString());
    }

    /**
     * Upcoming events in X days
     */
    public function scopeNextDays($query, $days)
    {
        return $query->whereBetween('start_at', [Carbon::today()->addDays(1)->toDateString(), Carbon::today()->addDays($days+1)->toDateString()]);
    }

    /**
     * Events by creator
     */
    public function scopeCreator($query, $creator)
    {   
        try{
            return $query->where('user_id', '=', $creator->id);
        } catch(Exception $e) {
            throw new Exception('Creator must be an instance of App\Models\User');
        }
        
    }
}
