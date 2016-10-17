<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Agent_history extends Eloquent {

	protected $fillable= ['agent_id','player_id','from_date','to_date'];


}
