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
class ProductsController extends Controller
{
public function add_product(Request $request)
    {
        $validate = Validator::make($request->all(),[

        'name'=>'required',
        'image'=>'required',
        'description'=>'required',
        'prep_time'=>'required',
        'price'=>'required',
        'discount_price'=>'required',

    ]);
        if($validate->fails()){

           return response($validate->errors());
        }

        $product = $request->user()->products()->create($request->all());
                if(request()->has('image')){
                    $product->update([
                    'image' => request()->image->store('uploads','public'),
                ]);
                }
        return apiresponse(1,'The Product is iserted',$product);
    }

    public function update_product(Request $request)
    {

        $validate = Validator::make($request->all(),[

        'name'=>'required',
        'image'=>'required',
        'description'=>'required',
        'prep_time'=>'required',
        'price'=>'required',
        'discount_price'=>'required',

    ]);
        if($validate->fails()){

           return response($validate->errors());
        }


        $product = $request->user()->products()->find($request->id);
        if($product){

        $product->update($request->all());
        return apiresponse(1,'The Product  Updated');
        }


        return apiresponse(0,'The Product didnt Updated');

    }

        public function delete_product(Request $request)
    {

        $validate = Validator::make($request->all(),[

    ]);
        if($validate->fails()){

          }
        $product = $request->user()->products()->find($request->id);
        
            
     if($product == null){
     return apiresponse(0,'this product is not exist');
      }
      $product->delete();
      return apiresponse(1,'The Product  deleted');
    }   



    public function resturant_product_list(Request $request){

       $products = $request->user()->products()->get();
      
       if($products != null){
        return apiresponse(1,'success',$products);
    }
    return apiresponse(0,'failed');
    }  
        

}



















