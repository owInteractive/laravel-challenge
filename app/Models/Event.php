<?php

namespace App\Models;

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

    protected $dates = [
        'start_at','end_at'
    ];

    /**
     * Get the event's owner
     */
    public function owner() {
        return $this->belongsTo(User::class,'user_id');
    }

    public static function boot() {

        parent::boot();
    
        static::creating(function($event) {
            $event->user_id = auth()->user()->id;
        });  
    }

    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description, 150, '...');
    }
}
