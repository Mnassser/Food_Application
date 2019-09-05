<?php

class CategoryRestaurant extends Model {

	protected $table = 'category_restaurant';
	public $timestamps = true;
	protected $fillable = array('category_id', 'restaurant_id');

}