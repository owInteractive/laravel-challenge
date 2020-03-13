<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property Carbon|string $start_at
 * @property Carbon|string $end_at
 * @property User $user
 * @property Collection $users
 * @method whereIn(string $string, array $ids)
 */
class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'start_at',
        'end_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_at',
        'end_at',
    ];

    /**
     * @param string $value
     * @return void
     */
    public function setStartAtAttribute($value): void
    {
        $this->attributes['start_at'] = Carbon::createFromFormat('Y-m-d\TH:i', $value);
    }

    /**
     * Personalizar data de inicio do evento
     *
     * @param string $value
     * @return string
     */
    public function getStartAtAttribute($value): string
    {
        $date = Carbon::createFromTimestamp(strtotime($value));

        return $date->format("Y-m-d\TH:i");
    }

    /**
     * @param string $value
     * @return void
     */
    public function setEndAtAttribute($value): void
    {
        $this->attributes['end_at'] = Carbon::createFromFormat('Y-m-d\TH:i', $value);
    }

    /**
     * Personalizar data de inicio do evento
     *
     * @param string $value
     * @return string
     */
    public function getEndAtAttribute($value): string
    {
        $date = Carbon::createFromTimestamp(strtotime($value));

        return $date->format("Y-m-d\TH:i");
    }

    /**
     * Usuario
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Usuarios convidados.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user')->withPivot('confirmed');
    }

    /**
     * Filtrar eventos do dia.
     *
     * @param Builder $query
     * @return void
     */
    public function scopeToday(Builder $query)
    {
        $today = app(Carbon::class);

        return $query->whereDate('start_at', $today->format('Y-m-d'));
    }

    /**
     * Filtrar eventos dos pŕoximos 5 dias.
     *
     * @param Builder $query
     * @return void
     */
    public function scopeNextFiveDays(Builder $query)
    {
        $now = app(Carbon::class);

        $first = $now->format('Y-m-d');

        $second = $now->addDays(5)->format('Y-m-d');

        return $query->whereBetween('start_at', [$first, $second]);
    }
}
