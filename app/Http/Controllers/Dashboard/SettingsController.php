<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index(){

    	$item = Setting::first();
    	return view('settings.index',compact('item'));


    }
     public function edit($id){

    	$item = Setting::find($id);
    	return view('settings.edit',compact('item'));


    }
    public function update(Request $request,$id){

         $item = Setting::findOrFail($id);
        $this->validate($request, [
            'about'=>'required|min:10',
            'commission_details'=>'required|max:40',
            'email'=>'required|max:40',
            'phone'=>'required|max:40',
            'facebook'=>'required|max:40',
            'whatsapp'=>'required|max:40',
            

        ]);
        $input = $request->all();
        $item->fill($input)->save();

        return redirect()->route('settings.index')
            ->with('flash_message',
             'item'. $item->name.' updated!');

    }
}
