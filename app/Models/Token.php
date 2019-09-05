<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Token extends Model {

	protected $table = 'tokens';
	public $timestamps = true;
	protected $fillable = array('tokenable_type', 'platform', 'token');

	public function resturants()
	{
		return $this->morphto('App\Models\Restaurant','tokenable');
	}
	public function clients()
	{
		return $this->morphto('App\Models\Client','tokenable');
	}




}