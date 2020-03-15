<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
	
	/**
	 * rules
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 18:02
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title'       => 'required',
			'description' => 'required',
			'start_at'    => 'required|date_format:"Y-m-d H:i"|before:end_at',
			'end_at'      => 'required|date_format:"Y-m-d H:i"|',
		];
	}
}
