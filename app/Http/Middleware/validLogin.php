<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class validLogin
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
        if (!Cookie::has('isLogin')) {
            return redirect('/login');
        }
        // if (!$request->session()->has('isLogin')) {
        //     return redirect('/login');
        // }

        // return "test2";

        return $next($request);
    }
}
