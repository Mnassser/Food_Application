<?php

namespace App\Http\Middleware;

use Closure;

class active
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
        if($request->user()->activated != 1){



            return apiresponse(1,'Your Acc Has Been Deactivated ');


        }

        return $next($request);
    }
}
