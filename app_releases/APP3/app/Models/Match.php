<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Match extends Eloquent {

	protected $fillable= [
	'team1_id','team2_id','match_date','match_period','group_id','champion_id','stadium_id','addition_info','date'
];

}
