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
class TokensController extends Controller
{
    public function create_client_token(Request $request){
        
 $validate = Validator::make($request->all(),[  
        'platform'=>'required',
            'token'=>'required|unique:tokens',
    ]);
        if($validate->fails()){
           return response($validate->errors());
        }
            
        $token=$request->user()->tokens()->create([

            'platform'=>$request->platform,
            'token'=>$request->token,

        ]);

        return apiresponse(1, 'The token has beenn created', $token); 


     }

public function delete_client_token(Request $request){
        
 $validate = Validator::make($request->all(),[  
            
            'token'=>'required|exists:tokens',
    ]);
        if($validate->fails()){
           return response($validate->errors());
        }
            
        $token=$request->user()->tokens()->delete();


        return apiresponse(1, 'The token has been deleted'); 


     }


     public function create_resturant_token(Request $request){
        
 $validate = Validator::make($request->all(),[  
            'platform'=>'required',
            'token'=>'required|unique:tokens',
    ]);
        if($validate->fails()){
           return response($validate->errors());
        }
            
        $token=$request->user()->tokens()->create([

            'platform'=>$request->platform,
            'token'=>$request->token,

        ]);

        return apiresponse(1, 'The token has beenn created', $token); 
     }


     
public function delete_resturant_token(Request $request){
        
 $validate = Validator::make($request->all(),[  
            
            'token'=>'required|exists:tokens',
    ]);
        if($validate->fails()){
           return response($validate->errors());
        }
            
        $token = $request->user()->tokens()->where('token',$request->token);



        $token->delete();

        return apiresponse(1, 'The token has beenn deleted'); 

     }
    


              
}
