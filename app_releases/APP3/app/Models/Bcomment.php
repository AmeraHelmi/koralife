<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Bcomment extends Eloquent {

	protected $fillable= ['blog_id','person_id','role','comment','date'];

}
