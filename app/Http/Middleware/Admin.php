<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach($guards as $guard) {
            if(Auth::guard($guard)->check() && (Auth::user()->role == role('super-admin') || Auth::user()->role == role('admin') || Auth::user()->role == role('manager'))) {
                return $next($request);
            }
        }

        return redirect()->route('auth.login');
    }
}
