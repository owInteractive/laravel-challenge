<?php

namespace App\Http\Requests\Api\Events;

use App\Rules\CheckDate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'title' => [
                'required',
                Rule::unique('events')->ignore($this->user()->id, 'user_id'),
            ],
            'users.*' => 'nullable|exists:users,id',
            'start_at' => [
                'required',
                'date_format:Y-m-d\TH:i',
                new CheckDate('lt', $this->input('end_at'))
            ],
            'end_at' => [
                'required',
                'date_format:Y-m-d\TH:i',
                new CheckDate('gt', $this->input('start_at'))
            ]
        ];
    }
}
