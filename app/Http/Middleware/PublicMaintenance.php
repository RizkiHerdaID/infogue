<?php

namespace Infogue\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class PublicMaintenance
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
        if(App::make('site_settings')['Status'] == 'maintenance'){
            return response()->view('errors.503', [], 503);
        }

        return $next($request);
    }
}
