<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'max:191|string',
            'description' => 'string',
            'start_datetime' => 'date_format:"Y-m-d\TH:i"',
            'end_datetime' => 'date_format:"Y-m-d\TH:i"|after:start_datetime',
        ];
    }
}
