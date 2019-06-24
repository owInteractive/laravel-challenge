<?php

namespace App\Events;

use App\Models\Guest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventInvitation
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Guest
     */
    public $guest;

    /**
     * Create a new event instance.
     *
     * @param Guest $guest
     */
    public function __construct(Guest $guest)
    {
        $this->guest = $guest;
    }
}
