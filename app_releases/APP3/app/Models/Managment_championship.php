<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Managment_championship extends Model {

	//
	protected $fillable= ['team_id','manager_id','from_date','to_date','contract','addition_info'];

}
