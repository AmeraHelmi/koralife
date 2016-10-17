<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Nation extends Eloquent {

	protected $fillable= [
		'country_id','continent','slogan','flag','nickname','start_date','stadium_id'
];

}
