<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PresenceFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          
        'id_user' =>'required',
        'id_event'=>'required',
        'invite_status'=>'required',
        
        ];
    }
    public function messages(){
        return [
            'id_user.required' =>'User  is Mandatory',
            'id_event.required' =>'Event  is Mandatory',
            'invite_status.required' =>'Status is Mandatory',
            

        ];
    }
}
