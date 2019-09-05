<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class DeletedMiddleware
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

        if($request->user()->deleted_at != null){

        return apiresponse(1,'Your Acc Has Been Deleted ');
    }
        
        return $next($request);
    }
}
