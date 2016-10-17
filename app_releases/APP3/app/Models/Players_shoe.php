<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Players_shoe extends Eloquent {

	protected $fillable= [
		'shoes_id','player_id','match_id'
];

}
