<?php

namespace App\Http\Requests;

class EventFormRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }
}