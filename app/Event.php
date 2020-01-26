<?php

namespace App;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_at',
        'end_at',
        'user_id',
    ];

    public function amIOwner(): bool
    {
        return $this->participants->find(auth()->id())->pivot->owner;
    }

    public function participants()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('owner')
            ->withTimestamps();
    }

    public static function groupByDay(Collection $events): array
    {
        $calendar = array();

        foreach ($events as $event) {
            $day = Carbon::parse($event->start_at)->toDateString();
            $calendar[$day][] = $event;
        }

        return $calendar;
    }

}
