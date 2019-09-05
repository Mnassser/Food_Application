<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\City;

class DistrictsController extends Controller
{
    public function index(){

    	$items = District::paginate(10);
    	return view('districts.index',compact('items'));


    }

    public function create() {
         $items = City::all(); //Get all items

        return view('districts.create')->with('items', $items);
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

        
        $district = District::create($request->all());

        return redirect()->route('districts.index')
            ->with('flash_message',
             'district'. $district->name.' added!');

    }


     public function edit($id){

    	$item = District::findOrFail($id);

        return view('districts.edit', compact('item'));


    }
     public function update(Request $request,$id){

    	 $item = District::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $input = $request->all();
        $item->fill($input)->save();

        return redirect()->route('districts.index')
            ->with('flash_message',
             'item'. $item->name.' updated!');

    }


    
        public function destroy(Request $request,$id){

        $item = District::findOrFail($id);

    //Make it impossible to delete this specific item    
    if ($item->name == "Administer items & items") {
            return redirect()->route('districts.index')
            ->with('flash_message',
             'Cannot delete this item!');
        }

        $item->delete();

        return redirect()->route('districts.index')
            ->with('flash_message',
             'item deleted!');

    }
    
 }