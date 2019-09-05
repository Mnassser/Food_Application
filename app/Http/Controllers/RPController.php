<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;


class RPController extends Controller
{
    public function create(){

    	//$role = Role::create(['name' => 'admin']);
	$permission = Permission::create(['name' => 'delete']);
		auth()->user()->assignRole('admin');
		auth()->user()->givePermissionTo('delete');
    }
}
