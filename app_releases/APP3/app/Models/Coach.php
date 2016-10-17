<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model as Eloquent;


class Coach extends Eloquent {

		protected $fillable= [
		'name','country_id','nickname','flag','city_id','role','additional_info','birth_date'
];

}
