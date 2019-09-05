<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(){

        $items = Product::paginate(10);
        return view('products.index',compact('items'));


    }

/*    public function create() {
        return view('products.create');
    }

    
    public function store(Request $request) {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        
        $district = Product::create($request->all());

        return redirect()->route('products.index')
            ->with('flash_message',
             'district'. $district->name.' added!');

    }


     public function edit($id){

        $item = Product::findOrFail($id);

        return view('products.edit', compact('item'));


    }
     public function update(Request $request,$id){

         $item = Product::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $input = $request->all();
        $item->fill($input)->save();

        return redirect()->route('products.index')
            ->with('flash_message',
             'item'. $item->name.' updated!');

    }

*/
    
        public function destroy(Request $request,$id){

        $item = Product::findOrFail($id);

    //Make it impossible to delete this specific item    
    if ($item->name == "Administer items & items") {
            return redirect()->route('products.index')
            ->with('flash_message',
             'Cannot delete this item!');
        }

        $item->delete();

        return redirect()->route('products.index')
            ->with('flash_message',
             'item deleted!');

    }
    
 }