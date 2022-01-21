<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * 
     * 
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * This function protects the administrator view
         * */
        if(!\Auth::user() || \Auth::user()->role->id != 1){
            return redirect('/operator');
        }
        return $next($request);
    }
}
