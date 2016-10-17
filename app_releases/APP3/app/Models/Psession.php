<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Psession extends Eloquent {

	protected $fillable= ['team_id','match_id','time','percent'];

}
