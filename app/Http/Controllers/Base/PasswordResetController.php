<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\Base\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function send(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|exists:users']);

        $credentials = $request->only('email');

        $response = $this->broker()->sendResetLink($credentials);

        return $response == Password::RESET_LINK_SENT ? $response : 'falhou';
    }

    /**
     * Alterar senha de acesso.
     *
     * @param UpdatePasswordRequest $request
     * @return mixed
     */
    public function change(UpdatePasswordRequest $request)
    {
        $operation = $this->broker()->reset($request->all(), function (User $user, $password) {
            # alterar senha
            $user->password = $password;
            $user->save();
        });

        $status_error = in_array($operation, [Password::INVALID_USER, Password::INVALID_TOKEN, Password::INVALID_PASSWORD]);

        if ($status_error) {
            return response()->json(__($operation), 400);
        }

        return response()->json(__("passwords.reset"));
    }

    /**
     * Auxiliar
     *
     * @return PasswordBroker
     */
    private function broker(): PasswordBroker
    {
        return Password::broker();
    }
}
