<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Utils\VerifyTokenRequest;
use Illuminate\Http\Request;

class UtilsController extends Controller
{
    /**
     * Verificar se token de redefinição é válido.
     *
     * @param VerifyTokenRequest $request
     * @return \Illuminate\Http\JsonResponse
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

    /**
     * Confirmar inscrição de usuario.
     *
     * @param Request $request
     * @param string $access_token
     * @param int $event_id
     * @return mixed
     */
    public function confirmed(Request $request, string $access_token, int $event_id)
    {
        //

        return 'okay';
    }
}
