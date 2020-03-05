<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\Base\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{

    use ThrottlesLogins;

    /**
     * @return string
     */
    protected function username(): string
    {
        return 'email';
    }

    /**
     * @param LoginRequest $request
     * @return mixed
     */
    public function __invoke(LoginRequest $request)
    {

        # verificar se atingiu o limite de tentativas
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            # em quanto tempo será desbloqueado
            $seconds = $this->limiter()->availableIn($this->throttleKey($request));

            # bloquear requisição
            return response()->json(__('auth.throttle', compact('seconds')), 429);
        }

        # verificar usuario
        $user = app(User::class)->where('email', $request->input('email'))->first();

        # verificar senha
        $check_password = app('hash')->check($request->input('password'), $user->password);

        if (!$check_password) {
            # informar tentativa
            $this->incrementLoginAttempts($request);
            #
            return response()->json('senha incorreta.', 401);
        }

        # obter token do usuario
        $token = $user->api_token;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }
}
