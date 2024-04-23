<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Jika peran pengguna adalah 'admin', arahkan ke halaman dashboard
                if (Auth::user()->role === 'admin') {
                    return redirect()->route('dashboard.index');
                }
                // Jika peran pengguna adalah 'user', arahkan ke halaman landing baru
                elseif (Auth::user()->role === 'user') {
                    return redirect()->route('landing');
                }
            }
        }

        return $next($request);
    }
}
