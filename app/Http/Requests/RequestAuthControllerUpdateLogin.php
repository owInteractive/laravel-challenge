<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class RequestAuthControllerUpdateLogin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->id == auth()->user()->id?true:false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(!$this->password && !$this->password_confirmation){
            return [
                'name'=>'required|string|max:90',
                'email'=>'required',Rule::unique('users')->ignore(auth()->user()->id),
            ];
        }else{

           return [
                'name'=>'required|string|max:90',
                'email'=>'required',Rule::unique('users')->ignore(auth()->user()->id),
                'password'=>'required|confirmed|string|min:4|max:10',
            ];
        }

    }
}