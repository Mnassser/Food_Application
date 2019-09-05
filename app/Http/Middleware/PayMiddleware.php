<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Order;
use App\Models\Payment;
class PayMiddleware
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

            $order = $request->user()->orders()->where('status', 'delevered');
        $data = [
        'commission'=>(double)$order->sum('commission'),
        'paid' => (double)Payment::sum('paid'),
    ];
         $op =  $data['commission'] - $data['paid'];



                         if($op > 500){
          
        return apiresponse(1,'Stop You must pay our pills = ',$data);
}








        return $next($request);
    }
}
