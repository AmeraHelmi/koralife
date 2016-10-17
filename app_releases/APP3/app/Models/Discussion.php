<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Discussion extends Eloquent {

		protected $fillable= [
	'match_id','analysis','Author','analysis_date'
];

}
