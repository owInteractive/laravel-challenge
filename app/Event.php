<?php

namespace App;

use App\Exceptions\EventCreationException;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

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

    /**
     * @param int|void $perPage
     * @return Collection|LengthAwarePaginator
     */
    public static function getAllEvents($perPage = null)
    {

        $allEvents = Event::query()
            ->whereHas('participants', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderBy('start_at');

        if (is_int($perPage) && $perPage > 0) {
            return $allEvents->paginate($perPage);
        }

        return $allEvents->get();
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

    /**
     * @param Event[] $events
     * @throws \InvalidArgumentException|EventCreationException
     * @return void
     */
    public static function createEvents(iterable $events)
    {

        foreach ($events as $event) {

            if (!is_a($event, Event::class)) {
                throw new \InvalidArgumentException();
            }

            if (empty($event->title)) {
                throw new EventCreationException('The title is required.');
            }

            if (empty($event->start_at)) {
                throw new EventCreationException('The start date is required.');
            }

            if (empty($event->end_at)) {
                throw new EventCreationException('The end date is required.');
            }

            $startAt = Carbon::parse($event->start_at);
            $endAt = Carbon::parse($event->end_at);

            if ($startAt->timestamp > $endAt->timestamp) {
                throw new EventCreationException('The end date should be greater than start date.');
            }

        }

        foreach ($events as $event) {

            $event->save();

            /** @var User $user */
            $user = Auth::user();
            $user->events()->attach($event, ['owner' => true]);

        }

    }

}
