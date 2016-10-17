<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Corner extends Eloquent {

	protected $fillable= ['id','team_id','player_id','match_id','referee_id','time'];

	//

}
