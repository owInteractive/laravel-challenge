<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteEvent extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $user;
    public $invite;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, Invite $invite)
    {
        $this->event = $event;
        $this->invite = $invite;
        $this->user = auth()->user();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(auth()->user()->email)
            ->view('events.invitation_email');
    }
}
