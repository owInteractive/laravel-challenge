<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class ProfileChangePasswordFormRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required|same:new_password'
        ];
    }

}