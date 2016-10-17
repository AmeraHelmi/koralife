<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Blog extends Eloquent {

		protected $fillable= ['title','body','vedio_url','flag','author','date','cat_id'];

}
