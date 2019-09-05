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

use App\Mail\ResetPassword;
class ClientController extends Controller
{
     public function storeClient(Request $request)
    {
         $validate = Validator::make($request->all(),[

        'name'=>'required',
        'email'=>'required|unique:clients',
        'phone'=>'required',
        'password'=>'required|confirmed',
        'district_id'=>'required',
        'image'=>'required',





    ]);
        if($validate->fails()){

           return response($validate->errors());
        }
        $request->merge(['password' => bcrypt($request->password)]);



        $client = Client::create($request->all());

        

        $client->image = request()->image->store('uploads','public');
        $client->api_token = str_random(60);
        $client->save(); 
        return apiresponse(1,'Registeration is compelete');       

    
}
  public function loginClient(Request $request)
    {
          
        $validate = Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required'
    ]);
         if($validate->fails()){

           return response($validate->errors());
        }
        $client = Client::where('email','=',$request->email)->first();
        
        
            if(Hash::check($request->password,$client->password)){
                if($client->deleted_at != null){
                        return apiresponse(1,'Your Acc Has Been Deleted');
                }

            return apiresponse(1,'logged in',$client);
            return auth()->gaurd('api')->validate($request->all());

            }
            else{

                return apiresponse(0,'wrong password',null);
            }
     }
    public function clientProfile(Request $request)
    {        
         $validate = Validator::make($request->all(),[
        'id'=>'required',
        'name'=>'required',
        'email'=>'required',
        'phone'=>'required',
        'district_id'=>'required',
    ]);
        if($validate->fails()){

           return response($validate->errors());
        }

        $profile = Client::find($request->id);
        $profile->name = $request->name;
        $profile->email= $request->email;
        $profile->phone = $request->phone;
        $profile->district_id = $request->district_id;
        $profile->phone = $request->phone;

        
        $profile->save();
        return apiresponse(1,'success',$profile);
    }
    
    public function rate_resturat(Request $request)
    {
        
         $validate = Validator::make($request->all(),[

        'rate'=>'required',
        'comment'=>'required',
        'id' => 'exists:restaurants',



    ]);
        if($validate->fails()){

           return response($validate->errors());
        }
        $client_id = $request->user()->id;
         $restaurant_id=$request->id;  
        $rate = ClientRestaurant::updateOrCreate(
        ['client_id' => $client_id, 'restaurant_id' => $restaurant_id]);
        $rate->rate= $request->rate;
        $rate->comment = $request->comment;
        $star=$rate->where('restaurant_id',$restaurant_id)->avg('rate');
        $rate->save();
        $rates=Restaurant::find($restaurant_id)->update(['rate'=>$star]);//->update('rate',$star);
        
        return apiresponse(1,'Rate is compelete',$star);
    }

   
    
     
    
}


 
