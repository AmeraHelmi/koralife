<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Post extends Eloquent {

		protected $fillable= ['title','body','flag','alt','author','cat_id','date'];

}
