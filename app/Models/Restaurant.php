<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model {

	protected $table = 'restaurants';
	public $timestamps = true;
	protected $fillable = array('district_id', 'category_id', 'image', 'name', 'minimum_charge', 'delivery', 'phone', 'whatsapp', 'email', 'status', 'activated','api_token','password','rate');
	//protected $hidden = array('');

	public function contacts()
	{
		return $this->morphMany('App\Models\Contact');
	}

	public function offers()
	{
		return $this->hasMany('App\Models\Offer');
	}

	public function orders()
	{
		return $this->hasMany('App\Models\Order');
	}

	public function products()
	{
		return $this->hasMany('App\Models\Product');
	}


	public function commissions()
	{
		return $this->hasMany('App\Models\OrderProduct');
	}

	public function clients()
	{
		return $this->belongsToMany('App\Models\Client');
	}

	public function notifications()
	{
		return $this->morphMany('App\Models\Notification','notifiable');
	}

	public function tokens()
	{
		return $this->morphMany('App\Models\Token','tokenable');
	}

	public function category()
	{
		return $this->belongsTo('App\Models\Category','category_id');
	}

	public function district()
	{
		return $this->belongsTo('App\Models\District','district_id');
	}

	public function payment()
	{
		return $this->belongsTo('App\Models\Payment');
	}
		public function clientrestaurant()
	{
		return $this->hasMany('App\Models\ClientRestaurant');
	}
	public function settings()
	{
		return $this->hasOne('App\Models\Setting');
	}

		public function payments()
	{
		return $this->hasMany('App\Models\Payment');
	}

}