<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle(Request $request, Closure $next, ...$roles)
    // {
    //     // return $next($request);
    //     if(in_array($request->user()->role,$roles)){
    //         return $next($request);
    //     }
    //     return redirect('/');

    // }
    public function handle($request, Closure $next, ...$roles)
    {
         if(in_array($request->user()->role, $roles)){
            return $next($request);
        }
        return redirect('/');
    }
}
