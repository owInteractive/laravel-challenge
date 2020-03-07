<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class CheckTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        abort_if(!$request->has('token'), 400, 'informe o token de acesso.');

        # verificar se existe usuario
        $check = app(User::class)->where('api_token', $request->input('token'))->exists();

        abort_if(!$check, 401, 'não autorizado.');

        return $next($request);
    }
}
