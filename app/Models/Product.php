<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model {

	protected $table = 'products';
	public $timestamps = true;
	protected $fillable = array('image', 'name', 'description', 'prep_time', 'price', 'discount_price','restaurant_id');

	public function orders()
	{
		return $this->belongsToMany('App\Models\Order');
	}

	public function restaurant()
	{
		return $this->belongsTo('App\Models\Restaurant');
	}

}