<?php
namespace App\Repository;

use App\Repository\BaseRepository;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\Invitation;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvitie;

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
            EventRepository::sendInvites($event, $input);

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

    public static function sendInvites($event, $input)
    {
        if (isset($input['emails']) and count($input['emails'])) {
            $emails = explode(',', $input['emails']);
            foreach($emails as $email) {
                $invitation = Invitation::create(
                    [
                        'event_id' => $event->id,
                        'email' => trim($email),
                        'token' => static::setToken($email)
                    ]
                );

                Mail::to(['email' => $email])->send(new SendInvitie($invitation));
            }
        }

    }

    public static function setToken($email)
    {
        return md5(md5(uniqid(rand(), true)) . "#*&." . $email);
    }
}
