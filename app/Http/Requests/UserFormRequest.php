<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          
        'name' =>'required',
        'email'=>'required',
        'password'=>'required',
      
        
        ];
    }
    public function messages(){
        return [
            'name.required' =>'Name  is Mandatory',
            'email.required' =>'Email  is Mandatory',
            'password.required' =>'Password is Mandatory',
            

        ];
    }
}
