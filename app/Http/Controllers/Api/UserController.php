<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    /**
     * Obter dados do perfil do usuario.
     *
     * @return void
     */
    public function me(Request $request)
    {
        return $request->user();
    }

    /**
     * Atualizar dados do usuario.
     *
     * @param UpdateRequest $request
     * @return void
     */
    public function update(UpdateRequest $request)
    {
        $db = app('db');

        /** @var User $user */
        $user = $request->user();

        $response = null;

        try {
            # iniciar transação
            $db->beginTransaction();

            $user->fill($request->all());
            $user->saveOrFail();

            # autorizar
            $db->commit();

            $response = response($user);
        } catch (Throwable $e) {
            # reverter
            $db->rollback();

            $response = response()->json(['error' => $e->getMessage()], 400);
        } finally {
            return $response;
        }
    }
}
