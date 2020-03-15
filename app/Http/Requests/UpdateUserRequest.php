<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateUserRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
	
	public function rules(Request $request)
	{
		return [
			'name'     => 'required|unique:users,name,'.$request->input('id'),
			'email'    => 'required|email|unique:users,email,'.$request->input('id'),
			'password' => 'confirmed',
		];
	}
}
