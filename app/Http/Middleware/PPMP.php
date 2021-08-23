<?php

namespace App\Http\Middleware;

use Closure;

class PPMP
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
            $access = unserialize(base64_decode(auth()->user()->access_tokens));
            switch (true) {
                case (isset($access['wfp'])):
                    if ($access['wfp'] == 'wfpkey_2695841035') {
                        return $next($request);
                    }
                    return redirect('/')->with('error', "You have an invalid key. {e1} ");
                break;
                default:
                return redirect('/')->with('error', "You have an invalid key. {e2} ");
            break;
            }
        }else{
            return redirect('/')->with('error', "Please log in first. {e3} ");
        }
    }
}
