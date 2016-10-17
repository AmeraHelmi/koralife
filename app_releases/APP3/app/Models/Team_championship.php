<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Team_championship extends Model {

	//
	protected $fillable= [
		'team_id','championship_id','no_goals','no_points','no_draughts','no_winnes','no_loses'
	];

}
