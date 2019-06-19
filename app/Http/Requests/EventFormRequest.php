<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventFormRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' =>'required|min:3',
        'start'=>'required|max:200',
        'end'=>'required',
        'description'=>'required',
        ];
    }
    public function messages(){
        return [
            'title.required' =>'Title Field is Mandatory',
            'start.required' =>'Start Date Field is Mandatory',
            'end.required' =>'End Date Field is Mandatory',
            'description.required' =>'Description Field is Mandatory',

        ];
    }
}
