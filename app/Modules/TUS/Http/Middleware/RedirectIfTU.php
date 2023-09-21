<?php

namespace App\Modules\TUS\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * @see \Http\Middleware\RedirectIfAuthenticated
 */
class RedirectIfTU
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $guard = 'tu'): Response
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/tu');
        }

        return $next($request);
    }
}
