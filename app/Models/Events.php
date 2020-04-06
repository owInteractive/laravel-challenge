<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Events extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table = 'events';

    //protected $appends = ['title', 'description', 'event_starts_at', 'event_ends_at', 'id_user'];

    /**
     * Has Many Invites
     */
    public function invites()
    {
        return $this->hasMany('App\Models\EventsInvites', 'id_event');
    }

    /**
     * Belongs To User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }

    /*
     * Apply filter to query
     */
    public function scopeFilters($query){
        if (request('title')) {
            $query->where('title', 'rlike', request('title'));
        }
        if (request('description')) {
            $query->where('description', 'rlike', request('description'));
        }
        if (request('event_starts_at')) {
            $query->whereDate('event_starts_at', '=', Carbon::createFromFormat('d/m/Y', request('event_starts_at'))->format('Y-m-d'));
        }
        if (request('event_ends_at')) {
            $query->whereDate('event_ends_at', '=', Carbon::createFromFormat('d/m/Y', request('event_ends_at'))->format('Y-m-d'));
        }
        $query->whereNull('deleted_at')->orderBy('event_starts_at');
    }

    public function scopeAllEvents($query){
        $query->where('id_user', Auth::user()->id)->whereNull('deleted_at');
    }

    public function scopeNextDays($query, $days){
        $today = Carbon::today();
        $query->whereBetween('event_starts_at', [$today->format('Y-m-d'), $today->addDays($days)->format('Y-m-d')]);
    }
    public function scopeToday($query){
        $today = Carbon::today()->format('Y-m-d');
        $query->where('event_starts_at', $today);
    }

    public static function submit($params, $id_event = null){

        if($id_event){
            $event = Events::find($id_event);
        }else{
            $event = new Events;
        }

        $event->updated_at = Carbon::now();
        $event->title = $params->title;
        $event->description = $params->description;
        $event->id_user = Auth::user()->id;
        $event->event_starts_at = Carbon::createFromFormat('d/m/Y', $params->event_starts)->format('Y-m-d');;
        $event->event_ends_at = Carbon::createFromFormat('d/m/Y', $params->event_ends)->format('Y-m-d');
        $event->save();

        return $event;
    }

    public function getEventStartsAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function getEventEndsAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }
    public function getShortDescriptionAttribute($value){
        return Str::words($this->description,40);
    }

}
