<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Event $event
     * @return void
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * @param User $user
     * @param Event $event
     * @return void
     */
    public function update(User $user, Event $event)
    {
        return $event->user_id == $user->id;
    }

    /**
     * @param User $user
     * @param Event $event
     * @return void
     */
    public function delete(User $user, Event $event)
    {

        return $event->user_id == $user->id;
    }
}
