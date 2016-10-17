<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Team_group extends Eloquent {

	protected $fillable= ['group_id','team_id','role','champion_id'];


}
