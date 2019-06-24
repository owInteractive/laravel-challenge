<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Builder;

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

    private function verifyGuest(Event $event)
    {
        $valid = false;

        $tokenBase64 = request()->get('token');

        /** @var Guest[] $guests */
        $guests = $event->whereHas('guests', function (Builder $query) use ($tokenBase64) {
            $query->where('token', $tokenBase64);
        });

        foreach ($guests as $guest) {
            if ($guest->validToken($tokenBase64)){
                $valid = true;
            }
        }
        return $valid;
    }

    public function view(User $user, Event $event)
    {
        return $this->verifyUser($user, $event) || $this->verifyGuest($event);
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
