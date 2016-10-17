<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Match_sponsor extends Eloquent {

	protected $fillable= [
		'match_id','sponsor_id'
];

}
