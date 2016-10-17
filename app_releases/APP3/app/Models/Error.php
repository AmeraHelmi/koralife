<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Error extends Eloquent {

	protected $fillable= ['id','player_id','team_id','referee_id','time','comment'];

	//

}
