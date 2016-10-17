<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Member extends Eloquent {

	protected $fillable= [
		'username','email','password','image'
];

}
