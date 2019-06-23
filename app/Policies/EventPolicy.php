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
     * @return bool
     */
    private function verifyUser(User $user, Event $event)
    {
        return $user->id === $event->user_id;
    }

    /**
     * Determine whether the user can create events.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the event.
     *
     * @param User $user
     * @param Event $event
     * @return mixed
     */
    public function update(User $user, Event $event)
    {
        return $this->verifyUser($user, $event);
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param User $user
     * @param Event $event
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {
        return $this->verifyUser($user, $event);
    }
}
