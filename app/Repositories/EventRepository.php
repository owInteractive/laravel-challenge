<?php


namespace App\Repositories;


use App\Event;
use App\Exceptions\EventCreationException;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventRepository
{

    /**
     * @param Event|Event[] $events
     * @throws \InvalidArgumentException|EventCreationException
     * @return void
     */
    public function createEvents($events)
    {

        // Wrap in a array if argument is a single event model
        if (is_a($events, Event::class)) {
            $events = array($events);
        }

        if (!is_iterable($events)) {
            throw new \InvalidArgumentException();
        }

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

        DB::beginTransaction();
        try {

            foreach ($events as $event) {

                $event->save();

                /** @var User $user */
                $user = Auth::user();
                $user->events()->attach($event, ['owner' => true]);

            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            throw new EventCreationException('Failed to persist events.');
        }

    }

    /**
     * @param void|int $perPage
     * @return Collection|LengthAwarePaginator
     */
    public function getAllEvents($perPage = null)
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

    public function getTodayEvents(): Collection
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

    public function getNextDaysEvents(int $days): Collection
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

}
