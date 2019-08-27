<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Invitation",
 *      required={"eventid", "email"},
 *      @SWG\Property(
 *          property="eventid",
 *          description="eventid",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="expiration",
 *          description="expiration",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="confirm",
 *          description="confirm",
 *          type="boolean"
 *      )
 * )
 */
class Invitation extends Model
{
    use SoftDeletes;

    public $table = 'invitations';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'eventid',
        'email',
        'code',
        'expiration',
        'confirm'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'eventid' => 'integer',
        'email' => 'string',
        'code' => 'string',
        'expiration' => 'datetime',
        'confirm' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'eventid' => 'required',
        'email' => 'required'
    ];

    public function event()
    {
        return $this->belongsTo('App\Models\Event','eventid');
    }
    
}
