<?php

namespace App\Http\Requests\Api\Events;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('events.update', $this->route('event'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'nullable',
                Rule::unique('events')->ignore($this->route('event')->id),
            ],
            'start_at' => 'nullable|date_format:Y-m-d\TH:i:s|check_date:lt,end_at',
            'end_at' => 'nullable|date_format:Y-m-d\TH:i:s|check_date:gt,start_at',
            'status' => 'nullable|in:pending,open,close',
        ];
    }
}
