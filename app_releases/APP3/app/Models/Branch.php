<?php namespace App\Models;



use Illuminate\Database\Eloquent\Model as Eloquent;


class Branch extends Eloquent {

	//
	protected $fillable= [
		'name','country_id','team_id','flag','city_id','addition_info'];

}
