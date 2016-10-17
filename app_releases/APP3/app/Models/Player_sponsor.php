<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Player_sponsor extends Model {

	//
	protected $fillable= [
		'player_id','sponsor_id','from_date','to_date','amount','addition_info'];

}
