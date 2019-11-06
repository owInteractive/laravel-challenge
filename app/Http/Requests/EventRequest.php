<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
            'title' => 'required|unique:events,title',
            'description' => 'required',
            'ts_start'    => 'required',
            'ts_end'      => 'required',
        ];
    }

    public function messages()
   {
       return [
           'title.required'  => 'O campo é obrigátorio',  
           'title.unique'    => 'Já existe um titulo cadastrado com este nome!',
           'description.required'  => 'O campo é obrigátorio',
           'ts_start.required'  => 'O campo é obrigátorio',
           'ts_end.required'  => 'O campo é obrigátorio',
       ];
   }
}
