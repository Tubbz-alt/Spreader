<?php

namespace App\Http\Middleware;

use Closure;

class Adminicate
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

        switch ($user->role) {
            case '1':
                return $next($request);

            case '2':
                return redirect('analytics');

            default:
                return redirect('/');
        }
    }
}
