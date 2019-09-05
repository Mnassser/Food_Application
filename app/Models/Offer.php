<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Offer extends Model {

	protected $table = 'offers';
	public $timestamps = true;
	protected $fillable = array('restaurant_id', 'image', 'name', 'description', 'start', 'end');

	public function restaurant()
	{
		return $this->belongsTo('App\Models\Restaurant');
	}

	public function notifications()
	{
		return $this->morphMany('App\Models\Notification','notifiable');
	}
}