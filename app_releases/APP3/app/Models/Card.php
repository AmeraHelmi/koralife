<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model {

	//
	protected $fillable= ['id','player_id','match_id','color','time','comment','referee_id'];


}
