<?php namespace App\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Tag extends Eloquent {

	//
	protected $fillable= ['page_id','meta_words','url_word'];
}
