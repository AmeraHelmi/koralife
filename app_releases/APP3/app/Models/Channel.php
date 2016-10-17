<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class Channel extends Eloquent {

	//
	protected $fillable= [
		'name','frequency','flag','url','addition_info'];

}
