<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Advert extends Eloquent {

	protected $fillable= ['name','flag','url','page_name','place','height','width'];

}
