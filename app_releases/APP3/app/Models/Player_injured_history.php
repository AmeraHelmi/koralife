<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Player_injured_history extends Eloquent {

	protected $fillable= [
             'injured_name','player_id','match_id',
             'from_date','to_date','nature_of_medicine',
             'medicine_place','addition_info'
             ];
}
