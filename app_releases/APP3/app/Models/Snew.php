<?php namespace App\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Snew extends Eloquent {

	//
	protected $fillable= ['title','flag','date','additional_info','user_id','cat_id'];
}
