<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventsInvites extends Model
{
    public $timestamps = true;
    protected $table = 'events_invites';

    /**
     * Belongs to event
     */
    public function event()
    {
        return $this->belongsTo('App\Models\Events', 'id_event');
    }

    public static function submit($params, $id_event){

        $invite = new EventsInvites;

        $invite->name_contact = $params->name;
        $invite->email = $params->email;
        $invite->id_event = $id_event;
        $invite->status = 0;
        $invite->save();

        return $invite;
    }

    public function getStatus(){
        switch ($this->status) {
            case 0:
                return 'Waiting';

            case 1:
                return 'Confirmed';

            case 2:
                return 'Refused';
            
            default:
                return '';
        }
    }

    public static function confirm($id_invite){

        $invite = EventsInvites::find($id_invite);
        $invite->status = 1;
        $invite->save();

        return $invite;
    }

    public static function refuse($id_invite){

        $invite = EventsInvites::find($id_invite);
        $invite->status = 2;
        $invite->save();

        return $invite;
    }
}
