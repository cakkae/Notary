<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            if (Auth::user()->hasRole('User')) { 
                return redirect('/orders');
            }

            if (Auth::user()->hasRole('Client')) { 
                return redirect('/orders');
            }

            if (Auth::user()->hasRole('Admin')) { 
                return redirect('/admin');
            }

            if (Auth::user()->hasRole('Vendor')) { 
                return redirect('/vendor');
            }

            if (Auth::user()->hasRole('Owner')) { 
                return redirect('/owner');
            }
            // return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
