<?php

namespace App\Listeners;

use App\Events\EventInvitation;
use App\Notifications\SendInvitation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendGuestInvitationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EventInvitation  $event
     * @return void
     */
    public function handle(EventInvitation $event)
    {
        $event->guest->notify(new SendInvitation($event->guest));
    }
}
