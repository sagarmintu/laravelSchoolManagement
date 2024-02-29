<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class ParentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type == 4)
            {
                return $next($request);
            }
            else
            {
                Auth::logout();
                return redirect(url(''));
            }
        }
        else
        {
            Auth::logout();
            return redirect(url(''));
        }
    }
}
