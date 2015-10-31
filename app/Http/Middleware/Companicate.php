<?php

namespace App\Http\Middleware;

use Closure;

class Companicate
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
        if (!$user = $request->user()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }

        if ($user->role > 2) {
            return redirect('auth/logout');
        }
        return $next($request);
    }
}
