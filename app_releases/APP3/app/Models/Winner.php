<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model {

	protected $fillable= [
		'win_date','no_goals','no_points','additional_info','team_id','championship_id'];

}
