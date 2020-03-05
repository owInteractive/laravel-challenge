<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\Base\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return mixed
     */
    public function __invoke(RegisterRequest $request)
    {
        $db = app('db');
        $user = app(User::class);
        $response = null;

        try {
            # iniciar transação
            $db->beginTransaction();

            $user->fill($request->all());
            $user->save();

            # autorizar
            $db->commit();

            $response = response()->json($user, 201);
        } catch (Throwable $e) {
            # reverter
            $db->rollback();

            $response = response()->json(['error' => $e->getMessage()], 400);
        } finally {
            return $response;
        }
    }
}
