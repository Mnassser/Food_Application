<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Models\Client;
use App\Models\Restaurant;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Product;
use App\Models\City;
use App\Models\District;
use App\Models\Offer;
use App\Models\ClientRestaurant;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Payment;
class MainController extends Controller
{
       
    
            public function resturantList(){

       $categories = Restaurant::where('status','opened')->get();
        return apiresponse(1,'success',$categories);

    } 

    public function productList(Request $request){

       $products = Product::where('restaurant_id',$request->id);
      
       if($products->exists()){
        return apiresponse(1,'success',$products->get());
    }
    return apiresponse(1,'failed');
    }  



    public function cityList(){

       $cities = City::all();
        return apiresponse(1,'success',$cities);

    }

    public function districtList(Request $request){

       $district = District::where('city_id',$request->id);
       if($district->exists()){
        return apiresponse(1,'success',$district->get());
    }

    return apiresponse(0,'there is no district');

    }




    public function Product(Request $request){

       $product = Product::find($request->id);

       if($product){
        return apiresponse(1,'success',$product);
        }
        return apiresponse(0,'this Product dose not exists');
    }
    public function Rates(Request $request){

       $rates = ClientRestaurant::where('restaurant_id',$request->id);
    if($rates->exists()){

        return apiresponse(1,'success',$rates->get());
    }
     return apiresponse(0,'not exists',$rates);
    }
    


     public function RestInfo(Request $request){

       $info = Restaurant::find($request->id);
       
        return apiresponse(1,'success',$info);

    }     
 



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
   




    public function Report(Request $request)
    {
         $validate = Validator::make($request->all(),[

        'name'=>'required',
        'email'=>'required',
        'phone'=>'required',
        'message'=>'required',
        'type'=>'required',




    ]);
        if($validate->fails()){
            
           return response($validate->errors());
            }

$report = Contact::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'message'=>$request->message,
        'type'=>$request->type,
    ]);

        
        
        return apiresponse(1,'The message has ben sent');       

    }

    public function searchByCity(Request $request)
    {
         $validate = Validator::make($request->all(),[
        'id'=>'required',
    ]);
        if($validate->fails()){
            
           return response($validate->errors());
            }

            $restaurant = City::with('districts.restaurants')->where('id',$request->id)->first();

        return apiresponse(1,'Welcome',$restaurant);       

    }

     public function searchByName(Request $request)
    {
         $validate = Validator::make($request->all(),[
        'name'=>'required',
    ]);
        if($validate->fails()){
            
           return response($validate->errors());
            }

            $restaurant = Restaurant::where('name',$request->name)->orWhere('name', 'LIKE', '%' . $request->name . '%')->get();

        return apiresponse(1,'Welcome',$restaurant);       

    }
    public function settings(Request $request){

        $settings = Setting::first();

        return apiresponse(1, 'settengs has been created',$settings);

    }


     public function rates_list(Request $request){

        $rates = ClientRestaurant::where('restaurant_id',$request->id)->get();

        return apiresponse(1, 'all Rates of single resturant: ',$rates);

    }

    public function commission(Request $request){
        $order = $request->user()->orders()->where('status', 'delevered');
            
       


        $data = [
        'add_price' => (double)$order->sum('additional_cost'),
        'total' => (double)$order->sum('total_price'),
        'net' =>(double)$order->sum('total_price') - $order->sum('additional_cost'),
        'commission'=>(double)$order->sum('commission'),
        'paid' => (double)Payment::sum('paid'),
    ];

         $op = $data['commission'] - $data['paid'];

                if($op < 500){
            return apiresponse(1,'success',$data);
}
            return apiresponse(0,'you must pay = ',$op);



           }



}
