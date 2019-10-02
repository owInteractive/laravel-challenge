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

        dd($request->user()->id, $request->route('user'));
        if( $request->user()->id != $request->route('user') ){
 
            abort(403, 'Access denied');
            
          }
     
          return $next($request);
    }
}
