<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'last_modified',
    ];

    /**
     * @param string $value
     * @return string
     */
    public function getCreatedAtAttribute($value): string
    {
        return Carbon::createFromTimeString($value)->format('d/m/Y H:i:s');
    }

    /**
     * @param string $value
     * @return string
     */
    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::createFromTimeString($value)->format('d/m/Y H:i:s');
    }

    /**
     * Data de última modificação formato (humano)
     *
     * @return string
     */
    public function getLastModifiedAttribute(): string
    {
        $updated = $this->attributes['updated_at'];

        return Carbon::createFromTimeString($updated)->diffForHumans();
    }

    /**
     * Eventos iniciados pelo usuario.
     *
     * @return HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function sharedWithMe(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_user')->withPivot('confirmed');
    }

    /**
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
