<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Utils\VerifyTokenRequest;

class UtilControllers extends Controller
{
    /**
     * Verificar se token de redefinição existe.
     *
     * @param VerifyTokenRequest $request
     * @return void
     */
    public function verify_token(VerifyTokenRequest $request)
    {
        $token = $request->input('token');

        $tokens = app('db')->table('password_resets')->get();

        $exists = $tokens->filter(function ($item) use ($token) {
            return app("hash")->check($token, $item->token);
        })->first();

        if (!$exists) {
            return response()->json('not_found', 404);
        }

        return response()->json($exists);
    }
}
