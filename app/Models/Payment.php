<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Payment extends Model {

	protected $table = 'payment';
	public $timestamps = true;
	protected $fillable = array('restaurant_id','paid');

	public function restaurant()
	{
		return $this->belongsTo('App\Models\Restaurant','restaurant_id');
	}

}