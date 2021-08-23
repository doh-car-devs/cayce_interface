<?php

namespace App\Http\Middleware;

use Closure;

class HDF
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
        $lifetime = 1;
        config(['session.lifetime' => $lifetime]);
        return $next($request);
    }
}
