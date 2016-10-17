<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Player_match extends Eloquent {

	protected $fillable= [
		'player_id','match_id','team_id','from_time','to_time'
];

}
