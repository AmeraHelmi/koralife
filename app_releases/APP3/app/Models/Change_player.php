<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Change_player extends Model {

	//
	protected $fillable= ['id','player1_id','player2_id','team_id','match_id','ch_time'];
}
