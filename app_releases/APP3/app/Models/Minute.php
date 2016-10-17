<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
class Minute extends Eloquent
{
    protected $fillable=['match_id','body','minute'];
}