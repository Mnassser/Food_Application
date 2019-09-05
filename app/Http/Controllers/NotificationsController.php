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
class NotificationsController extends Controller
{

    public function resturant_notification_list(Request $request)
    {        
         $notifications = $request->user()->notifications;
        return apiresponse(1,'success',$notifications);
    }

     public function resturant_notification(Request $request)
    {        
                     $notification = $request->user()->notifications()->where('id',$request->id);


         $get=$notification->get();

        if($notification){
                $notification->update([

                    'is_read' => 1,


                ]);
            }
        return apiresponse(1,'success',$get);
    }
  


    public function client_notification_list(Request $request)
    {        
         $notifications = $request->user()->notifications;
        return apiresponse(1,'success',$notifications);
    }

     public function client_notification(Request $request)
    {        
         $notification = $request->user()->notifications()->where('id',$request->id);


         $get=$notification->get();

        if($notification){
                $notification->update([

                    'is_read' => 1,


                ]);
            }
        return apiresponse(1,'success',$get);
    }



    


              
}
