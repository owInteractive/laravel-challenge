<?php
namespace App\Repository;

use App\Repository\BaseRepository;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventUser;
use DB;
use Auth;

class EventRepository extends BaseRepository
{
    protected $modelClass = Event::class;

    public function get()
    {
        return $this->newQuery()->first();
    }

    public function create($input)
    {
        try {

            DB::beginTransaction();
            
            $dateTime       = self::setDateTime($input);
            $input['start'] = $dateTime['start'];
            $input['end']   = $dateTime['end'];

            $event  = Event::create($input);
            
            EventRepository::setEventUser($event);

            DB::commit();

            return $event;

        } catch (\Exception $e) {
            DB::rollback();
            // dd($e);
            return $e;
        }
    }
    
    public function update($input)
    {
        $dateTime       = self::setDateTime($input);
        $input['start'] = $dateTime['start'];
        $input['end']   = $dateTime['end'];

        $event  = Event::find()->update($input);

        return $event;
    }


    public static function setDateTime($input)
    {
        return ['start' => $input['start_date'] .' ' . $input['start_time'], 'end' => $input['end_date'] .' ' . $input['end_time']];   
    }
    
    public static function setEventUser($event)
    {
        return EventUser::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'accept' => 1
        ]);
    }

    public function today() {
        $now = Carbon::now();
        return $this->newQuery()->whereRaw("DATE(start) <= \"{$now->format('Y-m-d')}\" and DATE(end) >= \"{$now->format('Y-m-d')}\" ")->get();
    }

    public function nextDays() {
        $now = Carbon::now();
        $end = Carbon::now()->addDays(5);

        return $this->newQuery()->where(function($query) use($now, $end) {
            $query->whereBetween('start', [$now, $end])->orWhereBetween('end', [$now, $end]);
        })->get();
    }
}
