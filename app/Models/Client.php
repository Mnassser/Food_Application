<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Client extends Model {

	protected $table = 'clients';
	public $timestamps = true;
	protected $fillable = array('district_id', 'name', 'email', 'phone', 'api_token','password');
	protected $hidden = array('');

	public function contacts()
	{
		return $this->morphMany('App\Models\Contact');
	}

	public function orders()
	{
		return $this->hasMany('App\Models\Order');
	}

	public function restaurants()
	{
		return $this->belongsToMany('App\Models\Restaurant');
	}

	public function notifications()
	{
		return $this->morphMany('App\Models\Notification','notifiable');
	}

	public function tokens()
	{
		return $this->morphMany('App\Models\Token','tokenable');
	}

	public function district()
	{
		return $this->belongsTo('App\Models\District');
	}

}