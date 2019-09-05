<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Models\Client;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Product;
use App\Models\City;
use App\Models\District;
use App\Models\Offer;
use App\Models\ClientRestaurant;
use App\Models\Token;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Setting;
use App\Mail\ResetPassword;
class OrdersController extends Controller
{

       /*Resturant*/
    public function new_order_list(Request $request){

            $orders = $request->user()->orders()->where('status','pending')->paginate(10);
            if($orders != null){

             return apiresponse(1, 'New Orders List Is',$orders);
         }
         return apiresponse(1, 'there is no New Orders');
}

     public function old_order_list(Request $request){

            $orders = $request->user()->orders()->where('status','refuse')->orWhere('status','delevered')->paginate(10);

            if($orders != null){

             return apiresponse(1, 'found',$orders);
         }
             return apiresponse(0, 'this order already');
    }  

    public function pervious_order_list(Request $request){

        $orders = $request->user()->orders()->where('status','accepted')->orWhere('status','delevered')->paginate(10);

        if($orders != null){

         return apiresponse(1, 'found',$orders);
     }
         return apiresponse(0, 'this order already');
    }  

          public function accept_order(Request $request){

                $order = $request->user()->orders()->where('id',$request->order_id)->where('status','pending')->first();
                if($order != null){

                $order->update([
                    'status'=>'accepted',
                ]);

                ///////accepting  notification the client//////

                 $client=Client::find($order->client_id);
              $notification = $client->notifications()->create([
                'title'=>'تم قبول  الطلب من المطعم',
                'body'=>'تم قبول  الطلب من المطعم',
                'order_id'   => $order->id,
                    ]);
            
                    $token = $client->tokens()->where('token','!=','')->pluck('token')->toArray();
                    
                        $title = $notification->title;
                        $body = $notification->body.$request->user()->name;
                      
                    

                   $send = notifyByFirebase($title,$body,$token,[
                  'order_id' => $order->id
                   ]);
                  
                  

                 return apiresponse(1, 'accepted',$order);
             }
                 return apiresponse(0, 'this order already');
    } 


    public function declien_order(Request $request){

        $order = $request->user()->orders()->where('id',$request->order_id)->where('status','pending')->first();
            if($order != null){
        $order->update([
            'status'=>'refuse',
        ]);

    

            ///////notification the client//////
                  $client=Client::find($order->client_id);

          $notification = $client->notifications()->create([
            'title'=>'تم رفض الطلب من المطعم',
            'body'=>'يتم الان توصيل الطلب للعميل',
            'order_id'   => $order->id,
        ]);
        
                $token = $client->tokens()->where('token','!=','')->pluck('token')->toArray();
                
                    $title = $notification->title;
                    $body = $notification->body.$request->user()->name;
                  
                

               $send = notifyByFirebase($title,$body,$token,[
              'order_id' => $order->id
               ]);
            
             return apiresponse(1, 'decliend',$order);
         }

             return apiresponse(0, 'cannot open');
     } 

    public function delever_order(Request $request){

        $order = $request->user()->orders()->where('id',$request->order_id)->where('status','accepted')->first();
        if($order != null){

        $order->update([
            'status'=>'delevered',
        ]); 

            /////////////send notification ///////
                 $client=Client::find($order->client_id);
          $notification = $client->notifications()->create([
            'title'=>'يتم الان توصيل الطللب الى العميل',
            'body'=>'يتم الان توصيل الطلب للعميل',
            'order_id'   => $order->id,
        ]);
        
                $token = $client->tokens()->where('token','!=','')->pluck('token')->toArray();
                
                    $title = $notification->title;
                    $body = $notification->body.$request->user()->name;
                  
                

               $send = notifyByFirebase($title,$body,$token,[
              'order_id' => $order->id
               ]);
              




         return apiresponse(1, 'delevered',$order);
     }
         return apiresponse(0, 'this order already');
    }


    public function single_order(Request $request){

        $validate = Validator::make($request->all(),[
        'id'=>'required|exists:orders,id',
        
        ]);
        if($validate->fails()){
           return response($validate->errors());
        }
        $order = $request->user()->orders()->where('id',$request->id)->get();
         return apiresponse(1, 'this single order',$order);
    }   

/*___________*/

/*Clients*/
    public function client_create_order(Request $request){
         $validate = Validator::make($request->all(),[
            'restaurant_id'=>'required|exists:restaurants,id',
            'products'             => 'required|array',
            'products.*'           => 'required|exists:products,id',
            'quantity'=> 'required|array',
            'address'=>'required',
            ]);
            if($validate->fails()){
               return response($validate->errors());
            }
            $restaurant = Restaurant::find($request->restaurant_id);
            if($restaurant->status == 'closed'){

                return apiresponse(0,'this restaurant the closed');
            }
           $order = $request->user()->orders()->create([
            'restaurant_id'=>$request->restaurant_id,
            'notes'=>$request->notes,
            'state'=>'pending',
            'address'=>$request->address,
            'payment'=>$request->payment,
           ]);
           $cost = 0;
           $additional_cost = $restaurant->delivery;
            $counter = 0;
                foreach ($request->products as $productId) {
                    $product = Product::find($productId);
                    $order->products()->attach([
                    $productId => [
                        'quantity' => $request->quantity[$counter],
                        'price'    => $product->price,
                        'notes'     => '',
                    ]
                   ]);
                    $cost += ($product->price * $request->quantity[$counter]);
                    $counter++;
                }
            if($cost >= $restaurant->minimum_charge){
                $commission_value = Setting::pluck('commission_details')->first();
                $total = $cost + $additional_cost;
                $commission = $cost * $commission_value;
                $net = $total - $commission;
                $update= $order->update([
                    'additional_cost' => $additional_cost,
                    'total_price'=>$total,
                    'commission'=>$commission,        
                ]);
               
            //$request->user()->cart()->detach();
            $notification = $restaurant->notifications()->create([
                    'title'=>'محمد عبد الناصر',
                    'body'=>'طلب من العميل ',
                    'order_id'   => $order->id,
            ]);
            }
                        $token = $restaurant->tokens()->where('token','!=','')->pluck('token')->toArray();
                        
                            $title = $notification->title;
                            $body = $notification->body.$request->user()->name;
                          
                        

                       $send = notifyByFirebase($title,$body,$token,[
                      'order_id' => $order->id
                       ]);
      
              


         return apiresponse(1, 'تم الطلب بنجاح', $order);  
        }

    public function client_refuse_order(Request $request){

        $order = $request->user()->orders()->where('id',$request->order_id)->where('Cstatus','pending')->first();
        if($order != null){

            $order->Cstatus = 'refuse';
            $order->save();

            $restaurant=Restaurant::find($order->restaurant_id);

        
            ///////notification the client//////
                    $notification = $restaurant->notifications()->create([
            'title'=>'تم رفض الطلب الخاص ب هذا العميل',
            'body'=>'م رفض الطلب الخاص ب هذا العميل',
            'order_id'   => $order->id,
        ]);
        
                $token = $restaurant->tokens()->where('token','!=','')->pluck('token')->toArray();
                
                    $title = $notification->title;
                    $body = $notification->body.$request->user()->name;
                  
                

               $send = notifyByFirebase($title,$body,$token,[
              'order_id' => $order->id
               ]);
          
          
         return apiresponse(1, 'decliend',$order);
     }
         return apiresponse(0, 'this order already');
    }   


    public function client_Accept_Order(Request $request){

        $order = $request->user()->orders()->where('id',$request->order_id)->where('Cstatus','pending')->where('status','delevered')->first();
        if($order != null){

            $order->Cstatus = 'accepted';
            $order->save();


    
        ///////notification the client//////


            $restaurant=Restaurant::find($order->restaurant_id);

    
            ///////notification the client//////
                     $notification = $restaurant->notifications()->create([
            'title'=>'تم الموافقة  علي الطلب',
            'body'=>'تم الموافقة  علي الطلب',
            'order_id'   => $order->id,
        ]);
        
                $token = $restaurant->tokens()->where('token','!=','')->pluck('token')->toArray();
                
                    $title = $notification->title;
                    $body = $notification->body.$request->user()->name;
              
            

           $send = notifyByFirebase($title,$body,$token,[
          'order_id' => $order->id
           ]);
          
          
         return apiresponse(1, 'accepted',$order);
     }
         return apiresponse(0, 'this order already');
    }  

public function time_order_list(Request $request){

        $orders = $request->user()->orders()->where('status','delevered')->where('Cstatus','pending')->paginate(10);
        if($orders != null){

         return apiresponse(1, 'New Orders List Is',$orders);
     }
     return apiresponse(1, 'there is no New Orders');
}

    public function now_order_list(Request $request){

        $orders = $request->user()->orders()->where('status','accepted')->paginate(10);
        if($orders != null){

         return apiresponse(1, 'New Orders List Is',$orders);
     }
     return apiresponse(1, 'there is no New Orders');
    }
    /*___________*/
}



















