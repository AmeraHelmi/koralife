<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Player extends Eloquent {

	//
	protected $fillable= [
		'name','nickname','flag','city_id','country_id','prefered_foot','weight','height','speed','num','position','birth_date','facebook',
		'instagram','twitter','addition_info','nationality'

];

}
