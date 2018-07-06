<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:191|string',
            'description' => 'required|string',
            'start_datetime' => 'required|date_format:"Y-m-d\TH:i"',
            'end_datetime' => 'required|date_format:"Y-m-d\TH:i"|after:start_datetime',
        ];
    }
}
