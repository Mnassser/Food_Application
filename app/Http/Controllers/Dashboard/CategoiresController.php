<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoiresController extends Controller
{
    public function index(){

    	$items = Category::paginate(10);
    	return view('categories.index',compact('items'));


    }

    public function create() {
        return view('categories.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request) {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        
        $district = Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('flash_message',
             'district'. $district->name.' added!');

    }


     public function edit($id){

    	$item = Category::findOrFail($id);

        return view('categories.edit', compact('item'));


    }
     public function update(Request $request,$id){

    	 $item = Category::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $input = $request->all();
        $item->fill($input)->save();

        return redirect()->route('categories.index')
            ->with('flash_message',
             'item'. $item->name.' updated!');

    }


    
        public function destroy(Request $request,$id){

        $item = Category::findOrFail($id);

    //Make it impossible to delete this specific item    
    if ($item->name == "Administer items & items") {
            return redirect()->route('categories.index')
            ->with('flash_message',
             'Cannot delete this item!');
        }

        $item->delete();

        return redirect()->route('categories.index')
            ->with('flash_message',
             'item deleted!');

    }
    
 }