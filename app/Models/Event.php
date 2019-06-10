<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'starts_at', 'ends_in'
    ];

    protected $hidden = [
        'user_id'
    ];

    protected $dates = [
        'starts_at', 'ends_in'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invitations()
    {
        return $this->hasMany(Invite::class);
    }
}
