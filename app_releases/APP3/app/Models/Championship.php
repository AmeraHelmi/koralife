<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class Championship extends Eloquent {

	protected $fillable= [
		'name','country_id','addition_info','no_matches','type','year','ball_id','continent'
];

}
