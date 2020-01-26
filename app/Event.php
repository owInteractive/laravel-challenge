<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_at',
        'end_at',
    ];

    public function isOwner(int $userId): bool
    {
        $participant = $this->participants()->find($userId);

        if (!is_a($participant, User::class)) {
            return false;
        }
        return $participant->pivot->owner;
    }

    public function participants()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('owner')
            ->withTimestamps();
    }

}
