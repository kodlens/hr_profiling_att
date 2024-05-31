<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;


class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if($user->is_approve === 0){
            return redirect('/pending');
        }


        if(in_array(strtolower($user->role), ['employee', 'administrator'])){
            return $next($request);
        }

        abort(403);
    }
}
