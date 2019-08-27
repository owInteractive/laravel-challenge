<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Event",
 *      required={"title", "start", "owner"},
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="start",
 *          description="start",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="end",
 *          description="end",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="owner",
 *          description="owner",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Event extends Model
{
    use SoftDeletes;

    public $table = 'events';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'description',
        'start',
        'end',
        'owner'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'start' => 'datetime',
        'end' => 'datetime',
        'owner' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'start' => 'required',
        'owner' => 'required'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','owner');
    }
    
}
