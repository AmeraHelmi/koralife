<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class V_album extends Eloquent {

	protected $fillable= ['title','vedio_url','category_id','flag','description'];

}
