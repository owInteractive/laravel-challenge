<?php

namespace App\Mail;

use App\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class InviteParticipant extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $owner;
    public $joinUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, string $owner, string $token)
    {
        $this->event = $event;
        $this->owner = $owner;
        $this->joinUrl = URL::to("/events/join/{$token}");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('owcalendar@mail.com')
            ->subject("{$this->owner} is inviting you to {$this->event->title}")
            ->view('emails.invite');
    }
}
