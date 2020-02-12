<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class ProfileUpdateFormRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'email|required|unique:users,email,' . Auth::user()->id,
        ];
    }

}