<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
    ];

    protected $dates = [
        'start',
        'end',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Event $event) {
            if ($user = auth()->user()) {
                $event->user()->associate($user);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeToday(Builder $query)
    {
        return $query->whereDate('start', Carbon::today()->toDateString());
    }

    public function scopeNextFiveDays(Builder $query)
    {
        return $query->whereDate('start', '>=', Carbon::today()->toDateString());
    }

    public function scopeCurrentUser(Builder $query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function scopeEventsByFilter(Builder $query, $filter)
    {
        if ($filter === 'today') {
            $query->today();
        }

        if ($filter === 'next-five-days') {
            $query->nextFiveDays();
        }

        return $query;
    }

    public function setStartAttribute($value)
    {
        $this->attributes['start'] = Carbon::createFromFormat('Y-m-d\TH:i', $value);
    }

    public function setEndAttribute($value)
    {
        $this->attributes['end'] = Carbon::createFromFormat('Y-m-d\TH:i', $value);
    }

    public function getStartHumanAttribute()
    {
        return $this->start->diffForHumans();
    }

    public function getEndHumanAttribute()
    {
        return $this->end->diffForHumans();
    }
}
