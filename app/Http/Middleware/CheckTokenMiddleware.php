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
        $access_token = $request->input('token');

        if(!$access_token) {
            # extrair token da url
            preg_match('/confirmation\/([^?]+)\/\d/', $request->path(), $extract);
            # definir token
            $access_token = end($extract);
        }

        abort_if(!$access_token, 400, 'informe o token de acesso.');

        # verificar se existe usuario
        $check = app(User::class)->where('api_token', $access_token)->exists();

        abort_if(!$check, 401, 'não autorizado.');

        return $next($request);
    }
}
