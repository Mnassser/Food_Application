<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Contact extends Model {

	protected $table = 'contacts';
	public $timestamps = true;
	protected $fillable = array('name', 'email', 'phone', 'message', 'type', 'contactable_type', 'contactable_id');

	public function contactable()
	{
		return $this->morphTo();
	}

}