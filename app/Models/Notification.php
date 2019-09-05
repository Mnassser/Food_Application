<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Notification extends Model {

	protected $table = 'notifications';
	public $timestamps = true;
	protected $fillable = array('title', 'body', 'notifiable_id', 'notifiable_type','order_id');

	public function notifiable()
	{
		return $this->morphTo();
	}

	public function restaurant()
	{
		return $this->morphto('App\Models\Restaurant','notifiable');
	}
		public function offer()
	{
		return $this->morphto('App\Models\Offer','notifiable');
	}

}