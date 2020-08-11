<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EndTime implements Rule
{
    protected $start_date;
    protected $end_date;
    protected $start_time;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($start_date,$end_date,$start_time)
    {
        $this->start_date = $start_date;
        $this->end_date   = $end_date;
        $this->start_time = $start_time;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->start_date == $this->end_date){
            if($value < $this->start_time){
                return false;
            }
        }

        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a time after to start time.';
    }
}
