<?php

namespace App\Http\Controllers\Auth;

use App\Business\UserBusiness;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';
    private $userBusiness;

    public function __construct(UserBusiness $userBusiness)
    {
        $this->userBusiness = $userBusiness;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    protected function create(array $data)
    {
        return $this->userBusiness->create($data);
    }
}
