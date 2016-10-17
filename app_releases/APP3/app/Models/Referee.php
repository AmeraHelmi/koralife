<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Referee extends Eloquent {

	//
	protected $fillable= [
		'name','country_id','job','role','city_id','flag','additional_info','birth_date'
];

}
