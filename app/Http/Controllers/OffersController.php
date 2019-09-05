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
use App\User;
class OffersController extends Controller
{

 public function addOffer(Request $request){
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

            $offer = $request->user()->offers()->create($request->all());
            
               
          
          


            return apiresponse(1,'The Offer is iserted',$offer);

    }



    public function updateOffer(Request $request){
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

    public function deleteOffer(Request $request){
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

       
    public function offersList(){

       $offer = Offer::paginate(10);
       
        return apiresponse(1,'success',$offer);

        }


}

/////////////////////////////////////

















