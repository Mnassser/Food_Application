<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Setting extends Model {

	protected $table = 'settings';
	public $timestamps = true;
	protected $fillable = array('restaurant_id','about', 'elahly_bank', 'alrajhi_bank', 'commission_details', 'email', 'phone', 'facebook', 'instagram', 'twitter', 'linkedin', 'youtube', 'google', 'whatsapp');
	
	public function restaurant()

	{
		return $this->belongsTo('App\Models\Restaurant','restaurant_id');
	}

}