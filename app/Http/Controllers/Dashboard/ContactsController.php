<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Payment;
use App\Http\Controllers\Controller;

class ResturantsController extends Controller
{

     public function index(){

        $items = Restaurant::paginate(10)->where('deleted_at', null);
        return view('resturants.index',compact('items'));
    }
    public function update(Request $request,$id)
    {

        $resturant = Restaurant::find($id);

        if($resturant->activated == 1){

            $resturant->activated = 0;
            $resturant->save();
        return redirect('resturants');
        }

        elseif($resturant->activated == 0){

            $resturant->activated = 1;
            $resturant->save();
        return redirect('resturants');
    }
}


        public function destroy(Request $request,$id){

        $item = Restaurant::findOrFail($id);

    //Make it impossible to delete this specific item    
    if ($item->name == "Administer items & items") {
            return redirect()->route('resturants.index')
            ->with('flash_message',
             'Cannot delete this item!');
        }

        $item->deleted_at = now();
            
           $item->save();

        return redirect()->route('resturants.index')
            ->with('flash_message',
             'item deleted!');

    }
}

               
    
   


