<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

use function GuzzleHttp\json_decode;

class ValidAdmin
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
        } else {
            $isLogin = json_decode($request->cookie('isLogin'));
            if ($isLogin->role == 0) {
                return redirect('/login');
            }
        }

        return $next($request);
    }
}
