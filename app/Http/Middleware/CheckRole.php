<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        if (!Auth::check()) 
            return redirect('login');

        $user = Auth::user();
        if($user->status == '0')
            abort('403');

        foreach($roles as $role) {
            if($user->hasRole($role))
                return $next($request);
        }

        abort('403');
    }
}
