<?php

namespace Infogue\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($guard == 'admin') {
                return redirect()->guest('admin');
            }

            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'failure',
                    'message' => 'Unauthorized',
                    'timestamp' => Carbon::now(),
                ], 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }

        return $next($request);
    }
}
