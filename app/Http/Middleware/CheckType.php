<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Exception;

class CheckType
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
        if (Auth::user()->is_admin == '0') {
            return redirect('/dashboard'); // If user is not an admin. 
        }
        return $next($request);
    }
}
