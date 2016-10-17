<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model as Eloquent;


class Stadium extends Eloquent {

	//
	protected $fillable= [
		'name','country_id','caacity','ground','flag','city_id','addition_info'
];

}
