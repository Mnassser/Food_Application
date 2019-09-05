<?php


   function apiresponse($status,$message,$data=null){

$response=[
    'status'=>$status,
    'message'=>$message,
    'data'=>$data,
        ];



   return response()->json($response);
   }








/*// settings function
function settings()
{
    $settings = \App\Models\Setting::find(1);
    if($settings)
    {
        return $settings;
    } else {
        return new \App\Models\Setting;
    }
}
function responseJson($status, $msg, $data=null)
{
    $response = [
        'status' => $status,
        'message' => $msg,
        'data' => $data,
    ];
    return response()->json($response);
}
// send sms function
function smsMisr($to,$message)
{
    $url = 'https://smsmisr.com/api/webapi/?';
    $push_payload = array(
        "username" => "*****" , 
        "password" => "*****" , 
        "language" => "2", 
        "sender" => "ipda3" , 
        "mobile" => '2' . $to , 
        "message" => $message ,
    );
    $rest = curl_init();
    curl_setopt($rest, CURLOPT_URL, $url.http_build_query($push_payload));
    curl_setopt($rest, CURLOPT_POST, 1);
    curl_setopt($rest, CURLOPT_POSTFIELDS, $push_payload);
    curl_setopt($rest, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($rest, CURLOPT_HTTPHEADER,
        array(
            "Content-Type" => "application/x-www-form-urlencoded"
        ));
    curl_setopt($rest, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($rest);
    curl_close($rest);
    return $response;	
}*/
function notifyByFirebase($title,$body,$tokens,$data = [])        // paramete 5 =>>>> $type
{
// https://gist.github.com/rolinger/d6500d65128db95f004041c2b636753a
// API access key from Google FCM App Console
    // env('FCM_API_ACCESS_KEY'));
//    $singleID = 'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd';
//    $registrationIDs = array(
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd'
//    );
    $registrationIDs = $tokens;
// prep the bundle
// to see all the options for FCM to/notification payload:
// https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support
// 'vibrate' available in GCM, but not in FCM
    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'sound' => "default",
        'color' => "#203E78"
    );
// I haven't figured 'color' out yet.
// On one phone 'color' was the background color behind the actual app icon.  (ie Samsung Galaxy S5)
// On another phone, it was the color of the app icon. (ie: LG K20 Plush)
// 'to' => $singleID ;      // expecting a single ID
// 'registration_ids' => $registrationIDs ;     // expects an array of ids
// 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg,
        'data' => $data
    );
    $headers = array(
         'Authorization: key='.env('FIREBASE_API_ACCESS_KEY'),
         'Content-Type: application/json'
     );
 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
            ////////////////Ipda3 notifications one signal//////

 /*public function newOrder(Request $request)
    {

//        return $request->all();

        $validation = validator()->make($request->all(), [

            'restaurant_id'     => 'required|exists:restaurants,id',

            'products'             => 'required|array',

            'products.*'           => 'required|exists:products,id',

            'quantities'        => 'required|array',

            'notes'             => 'required|array',

            'address'           => 'required',

            'payment_method_id' => 'required|exists:payment_methods,id',

            //            'need_delivery_at' => 'required|date_format:Y-m-d',// H:i:s

        ]);

        if ($validation->fails()) {

            $data = $validation->errors();

            return responseJson(0, $validation->errors()->first(), $data);

        }

        $restaurant = Restaurant::find($request->restaurant_id);

        // restaurant closed

        if ($restaurant->availability == 'closed') {

            return responseJson(0, 'عذرا المطعم غير متاح في الوقت الحالي');

        }

        // client

        // set defaults

        $order = $request->user()->orders()->create([

                'restaurant_id'     => $request->restaurant_id,

                'note'              => $request->note,

                'state'             => 'pending', // db default

                'address'           => $request->address,

                'payment_method_id' => $request->payment_method_id,

          ]);

        $cost = 0;

        $delivery_cost = $restaurant->delivery_cost;

        if ($request->has('products')) {

            $counter = 0;

            foreach ($request->products as $productId) {

                $product = product::find($productId);

                $order->products()->attach([

                $productId => [

                    'quantity' => $request->quantities[$counter],

                    'price'    => $product->price,

                    'note'     => $request->notes[$counter],

                ]

               ]);

                $cost += ($product->price * $request->quantities[$counter]);

                $counter++;

            }

        }

        // minimum charge

        if ($cost >= $restaurant->minimum_charger) {

            $total = $cost + $delivery_cost; // 200 SAR

            $commission = settings()->commission * $cost; // 20 SAR  // 10 // 0.1  // $total; edited to remove delivery cost from percent.

            $net = $total - settings()->commission;

            $update = $order->update([

                             'cost'          => $cost,

                             'delivery_cost' => $delivery_cost,

                             'total'         => $total,

                             'commission'    => $commission,

                             'net'           => $net,

                                     ]);

            $request->user()->cart()->detach();

            // notification 

            $restaurant->notifications()->create([

                         'title'      => 'لديك طلب جديد',

                         'title_en'   => 'You have New order',

                         'content'    => 'لديك طلب جديد من العميل ' . $request->user()->name,

                         'content_en' => 'You have New order by client ' . $request->user()->name,

                         'order_id'   => $order->id,

                                     ]);

            $tokens = $restaurant->tokens()->where('token', '!=', '')->pluck('token')->toArray();

            $audience = ['include_player_ids' => $tokens];

            $contents = [

                'en' => 'You have New order by client ' . $request->user()->name,

                'ar' => 'لديك طلب جديد من العميل ' . $request->user()->name,

            ];

            $send = notifyByOneSignal($audience, $contents, [

                'user_type' => 'restaurant',

                'action'    => 'new-order',

                'order_id'  => $order->id,

            ]);

            $send = json_decode($send);

            // notification

            $data = [

                'order' => $order->fresh()->load('products') // $order->fresh()  ->load (lazy eager loading) ->with('products')

            ];

            return responseJson(1, 'تم الطلب بنجاح', $data);

        } 
        else {

            $order->products()->delete();

            $order->delete();

            return responseJson(0, 'الطلب لابد أن لا يكون أقل من ' . $restaurant->minimum_charger . ' ريال');

        }

}
    }*/

        ////////////Reset Password And Restores ///////
    /*

public function resetPassword(Request $request){
        $validate = Validator::make($request->all(),[
        'email'=>'required'
    ]);
        if($validate->fails()){
           return response($validate->errors());
        }
        
        $client=Client::where('email',$request->email)->first();

        
        
        if($client){
            $code=rand(1111,9999);
                $client->pin_code =$code;
                $client->save();
            Mail::to($client->email)
            ->bcc("juko2050@gmail.com")
            ->queue(new ResetPassword($code));
            return apiresponse(1,'The Code Has Been Sent Is:',$code);

        }
        if(!$client){
            $resturant=Restaurant::where('email',$request->email)->first();
                if($resturant){
                    $code=rand(1111,9999);
                        $resturant->pin_code =$code;
                        $resturant->save();
                    Mail::to($resturant->email)
                    ->bcc("juko2050@gmail.com")
                    ->queue(new ResetPassword($code));
                }
            return apiresponse(1,'The Code Has Been Sent Is:',$code);
        }
        else{
            return response()->json('Not Exists');
        }

    }
    public function restorePassword(Request $request){
        $validate = Validator::make($request->all(),[
        'email'=>'required',
        'pin_code'=>'required',
        'password'=>'required|confirmed'
    ]);
        if($validate->fails()){
           return response($validate->errors());
        }
        


        $client=Client::where('email',$request->email)->where('pin_code',$request->pin_code)->first();
        if($client){    
            $password=bcrypt($request->password);
                $password= Client::where('email',$request->email)->where('pin_code',$request->pin_code)->update(array('password' => $password));


            return response()->json('your client password has been changed');
            }
            if(!$client){

                    $resturant=Restaurant::where('email',$request->email)->where('pin_code',$request->pin_code)->first();
                        if($resturant){

                $password=bcrypt($request->password);
                $password= Restaurant::where('email',$request->email)->where('pin_code',$request->pin_code)->update(array('password' => $password));

                return response()->json('your resturant password has been changed');
                        }


                        
                    }
            
            return response()->json(' look at the data you inserted');
    
        
       



    }


    */


  



   