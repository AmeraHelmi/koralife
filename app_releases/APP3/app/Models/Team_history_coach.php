<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Team_history_coach extends Model {

	protected $fillable= [
		'team_id','coach_id','from_date','to_date','contract','addition_info'
	];

}
