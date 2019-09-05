<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OrderProduct extends Model {

	protected $table = 'order_product';
	public $timestamps = true;
	protected $fillable = array('order_id', 'product_id', 'quantity', 'price', 'delevered');





	public function restaurant()
	{
		return $this->belongsTo('App\Models\Restaurant','restaurant_id');
	}


}



