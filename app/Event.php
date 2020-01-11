<?php

namespace App;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

    public function getStartAtAsW3c()
    {
        return Carbon::parse($this->start_at)->format('Y-m-d\TH:i');
    }

    public function getEndAtAsW3c()
    {
        return Carbon::parse($this->end_at)->format('Y-m-d\TH:i');
    }

    public static function getTodayEvents(): Collection
    {
        $todayDate = Carbon::today()->toDateString();
        return Event::query()
            ->whereHas('participants', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->whereDate('start_at', '=', $todayDate)
            ->orderBy('start_at')
            ->get();
    }

    public static function getNextDaysEvents(int $days): Collection
    {
        $todayDate = Carbon::today()->toDateString();
        $nextDaysDate = Carbon::today()->addDay($days)->toDateString();
        return Event::query()
            ->whereHas('participants', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->whereDate('start_at', '>', $todayDate)
            ->whereDate('start_at', '<=', $nextDaysDate)
            ->orderBy('start_at')
            ->get();
    }

    public static function getAllEventsPaginated(int $perPage): LengthAwarePaginator
    {
        return Event::query()
            ->whereHas('participants', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderBy('start_at')
            ->paginate($perPage);
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
