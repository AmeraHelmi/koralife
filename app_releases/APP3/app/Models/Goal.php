<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Goal extends Eloquent {
	protected $fillable= [
	'player_id','match_id','championship_id','team_id','inteam_id','time','type'
];
}
