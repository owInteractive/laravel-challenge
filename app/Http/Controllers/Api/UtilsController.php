<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Utils\VerifyTokenRequest;
use App\Models\Event;
use App\Models\User;
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
    public function confirmed(string $access_token, int $event_id)
    {
        $response = null;
        $db = app('db');

        try {
            /** @var Event $event */
            $event = app(Event::class)->findOrFail($event_id);

            /** @var User $user */
            $user = app(User::class)->where('api_token', $access_token)->firstOrFail();

            # verificar se usuario pertence ao evento
            abort_if(!$event->users->contains('id', '=', $user->id), 400, 'você não foi convidado para esse evento.');

            $event_user = $event->users->firstWhere('id', '=', $user->id);
            $event_user->pivot->confirmed = 1;
            $event_user->pivot->save();

            $response = response()->redirectTo('/');
        }catch(\Throwable $e) {
            $response = response()->json($e->getMessage(), 400);
        } finally {
            return $response;
        }
    }
}
