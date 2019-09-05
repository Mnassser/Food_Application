<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;

class CitiesController extends Controller
{
    public function index(){

        $items = City::paginate(10);
        return view('cities.index',compact('items'));


    }

    public function create() {


        return view('cities.create');
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

        
        $item = City::create($request->all());

        return redirect()->route('cities.index')
            ->with('flash_message',
             'City'. $item->name.' added!');

    }


     public function edit($id){

        $item = City::findOrFail($id);

        return view('cities.edit', compact('item'));


    }
     public function update(Request $request,$id){

         $item = City::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $input = $request->all();
        $item->fill($input)->save();

        return redirect()->route('cities.index')
            ->with('flash_message',
             'item'. $item->name.' updated!');

    }


    
        public function destroy(Request $request,$id){

        $item = City::findOrFail($id);

    //Make it impossible to delete this specific item    
    if ($item->name == "Administer items & items") {
            return redirect()->route('cities.index')
            ->with('flash_message',
             'Cannot delete this item!');
        }

        $item->delete();

        return redirect()->route('cities.index')
            ->with('flash_message',
             'item deleted!');

    }
    
 }