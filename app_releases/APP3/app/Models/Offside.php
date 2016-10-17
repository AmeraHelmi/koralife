<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Offside extends Eloquent {

	protected $fillable= ['id','player_id','team_id','match_id','referee_id','time'];

	//

}
