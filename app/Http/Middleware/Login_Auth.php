<?php

namespace App\Http\Middleware;

use Closure;

class Login_Auth
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
        if(session()->has('id_admin')) {
            return $next($request);
        } else {
            return redirect(route('auth.index'))->with('pesan','silahkan login terlebih dahulu');
        }
    }
}
