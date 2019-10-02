<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SectionOwner
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

        
        if( $request->user()->id != (int)$request->route('user') ){
            
            return redirect('/home')->with('error', 'Você não tem permissão para acessar essa página.');;
            abort(403, 'Access denied');
            
          }
     
          return $next($request);
    }
}
