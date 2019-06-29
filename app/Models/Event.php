<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;
use App\Scopes\EventScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'user_id'
    ];

    protected static function boot() {
        parent::boot();
        static::bootUser();
        static::addGlobalScope(new EventScope);
    }

    protected static function bootUser() {
        static::created(function ($model) {
            $model->attributes['user_id'] = Auth::id();
            $model->save();
        });
    }


    protected $appends = ['start_date', 'start_time'];

    public function getStartDateAttribute()
    {
        return Carbon::parse($this->start)->format('Y-m-d');
    }
    public function getStartTimeAttribute()
    {
        return Carbon::parse($this->start)->format('H:i:s');
    }
    
    public function getEndDateAttribute()
    {
        return Carbon::parse($this->end)->format('Y-m-d');
    }
    public function getEndTimeAttribute()
    {
        return Carbon::parse($this->end)->format('H:i:s');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_users');
    }

    public function scopeProprietario($query)
    {
        $query->where('events.user_id', Auth::id());
    }

}
