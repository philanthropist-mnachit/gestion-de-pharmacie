<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->Role == 'USER'){
            
            return $next($request);
        }
        else
        {
            // Store the intended URL in the session
            session()->put('url.intended', url()->current());

            // Redirect the user to the login page
            // return redirect()->route('index');
            return redirect()->back();
            
        }
    }
}
