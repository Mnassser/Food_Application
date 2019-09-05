<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{

     public function index(){

        $items = Client::paginate(10)->where('deleted_at', null);
        return view('clients.index',compact('items'));
    }

    
        public function destroy(Request $request,$id){

        $item = Client::findOrFail($id);

    //Make it impossible to delete this specific item    
    if ($item->name == "Administer items & items") {
            return redirect()->route('clients.index')
            ->with('flash_message',
             'Cannot delete this item!');
        }

        $item->deleted_at = now();
            
           $item->save();

        return redirect()->route('clients.index')
            ->with('flash_message',
             'item deleted!');

    }
}

               
    
   


