<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SectionOwner
{
    public function handle($request, Closure $next)
    {   

        
        if( $request->user()->id != (int)$request->route('user') ){
            
            return redirect('/home')->with('error', 'You do not have permission to access this page.');;
            abort(403, 'Access denied');
            
          }
     
          return $next($request);
    }
}
