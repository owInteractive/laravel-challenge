<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
     * Personalizar data de inicio do evento
     *
     * @param string $value
     * @return void
     */
    public function getStartAtAttribute($value): string
    {
        $date = Carbon::createFromTimestamp(strtotime($value));

        return $date->toDateTimeLocalString();
    }

    /**
     * @param [type] $value
     * @return void
     */
    public function setStartAtAttribute($value): void
    {
        $this->attributes['start_at'] = Carbon::createFromFormat('Y-m-d\TH:i:s', $value);
    }

    /**
     * @param [type] $value
     * @return void
     */
    public function setEndAtAttribute($value): void
    {
        $this->attributes['end_at'] = Carbon::createFromFormat('Y-m-d\TH:i:s', $value);
    }

    /**
     * Personalizar data de inicio do evento
     *
     * @param string $value
     * @return void
     */
    public function getEndAtAttribute($value): string
    {
        $date = Carbon::createFromTimestamp(strtotime($value));

        return $date->toDateTimeLocalString();
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
