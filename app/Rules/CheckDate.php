<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckDate implements Rule
{
    /**
     * @var string
     */
    private $operator;
    /**
     * @var string
     */
    private $column;

    /**
     * CheckDate constructor.
     * @param string $operator
     * @param string|null $column
     */
    public function __construct(string $operator, $column)
    {
        $this->operator = $operator;
        $this->column = $column;
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
        # verificar se a data não ẽ anterior
        if(Carbon::now()->gt($this->column)) {
            return false;
        }
        return $this->operator === 'gt' ? ($value > $this->column) : ($value < $this->column);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'invalid date';
    }
}
