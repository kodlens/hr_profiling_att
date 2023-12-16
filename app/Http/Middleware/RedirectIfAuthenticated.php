<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                if(strtolower($user->role) === 'administrator'){
                    return redirect('/dashboard');
                }
                if(strtolower($user->role) === 'employee'){
                    return redirect('/employee/dashboard');
                }
                if(strtolower($user->role) === 'point_person'){
                    return redirect('/dashboard');
                }
                if(strtolower($user->role) === 'training_officer'){
                    return redirect('/dashboard');
                }

                //return redirect(RouteServiceProvider::HOME);
            }
        }
        return $next($request);


    }
}
