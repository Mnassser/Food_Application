<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model {

	protected $table = 'orders';
	public $timestamps = true;
	protected $fillable = array('client_id', 'address', 'special_order', 'notes', 'total_price', 'additional_cost', 'payment', 'status', 'commission','restaurant_id','product_id');

	public function products()
	{
		return $this->belongsToMany('App\Models\Product');
	}

	public function client()
	{
		return $this->belongsTo('App\Models\Client','client_id');
	}

	public function restaurant()
	{
		return $this->belongsTo('App\Models\Restaurant','restaurant_id');
	}

}