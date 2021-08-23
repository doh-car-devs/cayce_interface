<?php

namespace App\Http\Middleware;

use Closure;

class DivisionHead
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
            $access_group = auth()->user()->access_group;
            if($access_group == '98'){ 
                return $next($request);
            } else{ 
                return redirect()->back()->with('error', "This page is forbidden to your account.");
            } 
        }
        return redirect('/')->with('error', "Log in first!"); 
    }
}
