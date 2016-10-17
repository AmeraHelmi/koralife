<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Pcomment extends Eloquent {

	protected $fillable= ['post_id','person_id','role','comment','date'];

}
