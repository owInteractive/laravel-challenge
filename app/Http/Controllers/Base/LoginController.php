<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\Base\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return mixed
     */
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        $token = app('auth')->attempt($credentials);

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        # obter dados do usuario
        $user = app(User::class)->where('email', $request->input('email'))->first();

        dd($token);
        // return [
        //     'token' => $token,
        //     'expires' => app('auth')->factory()->getTTL() * 180,
        //     'user' => $user,
        // ];

        return $request->all();
    }
}
