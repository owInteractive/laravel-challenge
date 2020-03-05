<?php

namespace App\Http\Requests\Api\Events;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('events.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:events',
            'start_at' => 'required|date_format:Y-m-d H:i:s|check_date:lt,end_at',
            'end_at' => 'required|date_format:Y-m-d H:i:s|check_date:gt,start_at',
        ];
    }
}
