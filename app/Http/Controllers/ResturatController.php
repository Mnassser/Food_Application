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
class ResturatController extends Controller
{
    public function storeResturant(Request $request)
    {
          $validate = Validator::make($request->all(),[

        'name'=>'required|unique:restaurants',
        'email'=>'required|unique:restaurants',
        'phone'=>'required',
        'password'=>'required|confirmed',
        'image'=>'required',
        'minimum_charge'=>'required',
        'delivery'=>'required',
        'phone'=>'required|unique:restaurants',
        'whatsapp'=>'required',
        'status'=>'required',
        'district_id'=>'required',
        'category_id'=>'required'



    ]);
        if($validate->fails()){

           return response($validate->errors());
        }
         $request->merge(['password' => bcrypt($request->password)]);
        $restaurant = Restaurant::create($request->all());
         $restaurant->image = request()->image->store('uploads','public');
        $restaurant->api_token = str_random(60);
        $restaurant->save();
        return apiresponse(1,'Registeration is compelete');       

    }
     public function loginResturant(Request $request)
    { 


        $validate = Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required'
    ]);
         if($validate->fails()){

           return response($validate->errors());
        }
        $restaurant = Restaurant::where('email',$request->email)->first();
        
            
            if(Hash::check($request->password,$restaurant->password)){
                if($restaurant->deleted_at != null){
                        return apiresponse(1,'Your Acc Has Been Deleted');
                }

            return apiresponse(1,'logged in',$restaurant);
            return auth()->gaurd('api')->validate($request->all());

            }
            else{

                return apiresponse(0,'wrong password',null);
            }


    }
    


    public function updateOffer(Request $request)
    {
        $validate = Validator::make($request->all(),[

         'name'=>'required',
        'image'=>'required',
        'description'=>'required',
        'start'=>'required',
        'end'=>'required',
    ]);
        if($validate->fails()){
           return response($validate->errors());
        }


        $offer = $request->user()->offers()->find($request->id);



        if($offer){
        $offer->update($request->all());
        return apiresponse(1,'The offer  Updated',$offer);
    }


        return apiresponse(0,'The offer didnt Updated',$offer);
    }





       
        public function deleteOffer(Request $request)
    {
        $offer = $request->user()->offers()->find($request->id);

        if($offer){
        $offer->delete();
        return apiresponse(1,'The Product  deleted');
    }
    return apiresponse(0,'The Product is not found');
    }


        public function resturantOffersList(){

       $offer = $request->user()->offers()->paginate(10);
       
        return apiresponse(1,'success',$offer);

    }
    public function resturantProfile(Request $request)
    {        
         $validate = Validator::make($request->all(),[

        'name'=>'required',
        'email'=>'required',
        'phone'=>'required',
        'district_id'=>'required',
        'category_id'=>'required',
        'minimum_charge'=>'required',
        'delivery'=>'required',
        'status'=>'required',
        'whatsapp'=>'required',
        

    ]);
        if($validate->fails()){

           return response($validate->errors());
        }

        $profile = Restaurant::find($request->user()->id);
        $profile->name = $request->name;
        $profile->email= $request->email;
        $profile->phone = $request->phone;
        $profile->district_id = $request->district_id;
        $profile->category_id = $request->category_id;
        $profile->minimum_charge = $request->minimum_charge;
        $profile->delivery = $request->delivery;
        $profile->whatsapp = $request->whatsapp;
        $profile->status = $request->status;
        $profile->save();
        return apiresponse(1,'success',$profile);
    }

public function resturant_profile(Request $request)
    {        
         $validate = Validator::make($request->all(),[

        'name'=>'required',
        'email'=>'required',
        'phone'=>'required',
        'district_id'=>'required',
        'category_id'=>'required',
        'minimum_charge'=>'required',
        'delivery'=>'required',
        'status'=>'required',
        'whatsapp'=>'required',
        

    ]);
        if($validate->fails()){

           return response($validate->errors());
        }

        $profile = Restaurant::find($request->user()->id);
        $profile->name = $request->name;
        $profile->email= $request->email;
        $profile->phone = $request->phone;
        $profile->district_id = $request->district_id;
        $profile->category_id = $request->category_id;
        $profile->minimum_charge = $request->minimum_charge;
        $profile->delivery = $request->delivery;
        $profile->whatsapp = $request->whatsapp;
        $profile->status = $request->status;

        
        $profile->save();
        return apiresponse(1,'success',$profile);
    }


public function payment(Request $request)
    {        
         $validate = Validator::make($request->all(),[

        'paid'=>'required',

    ]);
        if($validate->fails()){

           return response($validate->errors());
        }

        $pay = $request->user()->payments()->create($request->all());

        return apiresponse(1,'success');
    }

      
    


              
}
