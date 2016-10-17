<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Team extends Eloquent {
	
	protected $fillable= [
		'name','slogan','flag','flag2','country_id','stadium_id','history','continent','coach_id','start_date','is_team','manager_id'

];


}
