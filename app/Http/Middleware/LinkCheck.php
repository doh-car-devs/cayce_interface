<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Closure;

class LinkCheck
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
        if (auth()->check()) {
            // add controller for updating lastseen
            // app('App\Http\Controllers\RequestsController')->updateLastSeen(12);
            foreach (session('user_links') as $key => $value) {
                if ($value->link == Route::getCurrentRoute()->getName()) {
                    return $next($request);
                }
            }
            return redirect()->back()->with('error', "FORBIDDEN {_E3}");
        }
    }
}
