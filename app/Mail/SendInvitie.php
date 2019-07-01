<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class SendInvitie extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitation, $event)
    {
        $this->invitation = $invitation;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invitie')
                    ->with('invite', $this->invitation)
                    ->with('event', $this->event)
                    ->from(Auth::user())
                    ->subject('You were invited to an event.');
    }
}
