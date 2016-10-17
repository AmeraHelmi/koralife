<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Penlty extends Eloquent {

	protected $fillable= ['id','player_id','match_id','referee_id','corner_side','time'];

	//

}
