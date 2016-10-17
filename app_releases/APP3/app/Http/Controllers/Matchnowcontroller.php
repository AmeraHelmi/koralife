<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Match;
use App\Models\Team_championship;
use App\Models\Player;
use App\Models\Commentor;
use App\Models\Referee;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;
use App\Models\Group;
use App\Models\Championship;
use App\Models\Psession;
use App\Models\Team;
use App\Models\Team_player;
use App\Models\Offside;
use App\Models\Penlty;
use App\Models\Corner;
use App\Models\Error;
use App\Models\Card;
use App\Models\Goal;
class Matchnowcontroller extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index($id)
	{
		$Allmatch= new Match;
		$Allmatch = $Allmatch
			->join('teams as T1', 'T1.id', '=', 'matches.team1_id')
			->join('teams as T2', 'T2.id', '=', 'matches.team2_id')
			->select(array('T1.name as T1name','T2.name as T2name'
					,'matches.id as match_id',
					'matches.team1_goals as team1_goals',
					'matches.team2_goals as team2_goals',
					'matches.match_date as match_date',
					'T1.flag as T1flag',
					'T2.flag as T2flag',
					'T1.id as T1ID',
					'T2.id as T2ID'
				))
			->where('date',date('Y-m-d'))->orderBy('match_id','desc')->get();
		$matchnow= new Match;
		$match_id = $matchnow->find($id);
		$match = $matchnow
		 	->join('teams as T1', 'T1.id', '=', 'matches.team1_id')
			->join('teams as T2', 'T2.id', '=', 'matches.team2_id')
		 	->select(array(
					'T1.name as T1name',
					'T2.name as T2name',
          			'matches.id as match_id',
					'matches.match_date as match_date',
					'matches.team1_goals as team1_goals',
					'matches.team2_goals as team2_goals',
		 			'T1.id as T1ID',
		 			'T2.id as T2ID',
					'matches.team1_corners as T1corners',
					'matches.team2_corners as T2corners',
					'matches.team1_offsides as T1offsides',
					'matches.team2_offsides as T2offsides',
					'matches.team1_errors as T1E',
					'matches.team2_errors as T2E',
					'matches.team1_cards as T1cards',
					'matches.team2_cards as T2cards',
					'matches.team1_psessions as T1psessions',
					'matches.team2_psessions as T2psessions',
					'matches.team1_penalties as T1penalties',
					'matches.team2_penalties as T2penalties'
				))
			->where('date',date('Y-m-d'))
			->where('matches.id',$id)->get();
		$players=Player::lists('name','id');
		$championships=Championship::lists('name','id');
		   	return view('Editor.now')
			->with('match',$match)
			->with('Allmatch',$Allmatch)
			->with('championships',$championships)
			->with('players',$players);
	}
	public function store(Request $request)
	{
	 	$penlty = new Penlty;
	 	$penlty->player_id           =$request->player_id;
	 	$penlty->match_id            =$request->matchid;
	 	$penlty->team_id             =$request->team_id;
	 	$penlty->time                =date('H:i:s');
   		$penlty->save();
	 	$count_penaltyT1 = $penlty->where('match_id',$request->matchid)->where('team_id',$request->T1)->count();
	 	$count_penaltyT2 = $penlty->where('match_id',$request->matchid)->where('team_id',$request->T2)->count();
   		$match = new Match;
	 	$match = $match->where('id',$request->matchid )->first();
	 	$match->team1_penalties =  $count_penaltyT1 ;
	 	$match->team2_penalties =  $count_penaltyT2 ;
   		$match->save();
	 	return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');
	}
	public function getplayers(Request $request)
	{
		$team_id = $request->team_id;
		$team_player = Team_player::where('team_id',$team_id)->get();
		foreach($team_player as $row){
		$player_name=Player::where('id',$row->player_id)->get(['name']);
		foreach($player_name as $row2){
				echo'<option value='.$row->player_id.'> '.$row2->name.' </option>';
				}
			}
	}
	public function offside(Request $request)
	{
	 	$offside = new Offside;
	 	$offside->player_id           =$request->player_id;
		$offside->match_id            =$request->matchid;
	 	$offside->team_id             =$request->team_id;
	 	$offside->time                =date('H:i:s');
   		$offside->save();
	 	$count_offsideT1 = $offside->where('match_id',$request->matchid)->where('team_id',$request->T1)->count();
	 	$count_offsideT2 = $offside->where('match_id',$request->matchid)->where('team_id',$request->T2)->count();
   		$match = new Match;
	 	$match = $match->where('id',$request->matchid )->first();
	 	$match->team1_offsides =  $count_offsideT1 ;
	 	$match->team2_offsides =  $count_offsideT2 ;
   		$match->save();
	 	return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');
	}
	public function corner(Request $request)
	{
		$corner = new Corner;
		$corner->player_id           =$request->player_id;
		$corner->match_id            =$request->matchid;
		$corner->team_id             =$request->team_id;
		$corner->time                =date('H:i:s');
	    $corner->save();
		$count_cornerT1 = $corner->where('match_id',$request->matchid)->where('team_id',$request->T1)->count();
		$count_cornerT2 = $corner->where('match_id',$request->matchid)->where('team_id',$request->T2)->count();
	   	$match = new Match;
		$match = $match->where('id',$request->matchid )->first();
		$match->team1_corners =  $count_cornerT1 ;
		$match->team2_corners =  $count_cornerT2 ;
	   	$match->save();
		return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');
	}
	public function Psession(Request $request)
	{
		$Psession = new Psession;
		$Psession->match_id            =$request->matchid;
		$Psession->team_id             =$request->team_id;
		$Psession->percent             =$request->percent;
		$Psession->time                =date('H:i:s');
		$Psession->save();
		$count_psessionT1 = $Psession->where('match_id',$request->matchid)->where('team_id',$request->T1)->sum('percent');
		$count_psessionT2 = $Psession->where('match_id',$request->matchid)->where('team_id',$request->T2)->sum('percent');
		$match = new Match;
		$match = $match->where('id',$request->matchid )->first();
		$match->team1_psessions =  $count_psessionT1 ;
		$match->team2_psessions =  $count_psessionT2 ;
		$match->save();
		return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');
	}
	public function error(Request $request)
	{
		$Error = new Error;
		$Error->player_id           =$request->player_id;
		$Error->match_id            =$request->matchid;
		$Error->team_id             =$request->team_id;
		$Error->time                =date('H:i:s');
	   	$Error->save();
		$count_errorT1 = $Error->where('match_id',$request->matchid)->where('team_id',$request->T1)->count();
		$count_errorT2 = $Error->where('match_id',$request->matchid)->where('team_id',$request->T2)->count();
	   	$match = new Match;
		$match = $match->where('id',$request->matchid )->first();
		$match->team1_errors =  $count_errorT1 ;
		$match->team2_errors =  $count_errorT2 ;
	   	$match->save();
		return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');
	}
	public function card(Request $request)
	{
		$card = new Card;
		$card->player_id          	=$request->player_id;
		$card->match_id           	=$request->matchid;
		$card->team_id            	=$request->team_id;
		$card->color             	=$request->cardcolor;
		$card->time                 =date('H:i:s');
		$card->save();
		$count_cardT1 = $card->where('match_id',$request->matchid)->where('team_id',$request->T1)->count();
		$count_cardT2 = $card->where('match_id',$request->matchid)->where('team_id',$request->T2)->count();
		$match = new Match;
		$match = $match->where('id',$request->matchid )->first();
		$match->team1_cards =  $count_cardT1 ;
		$match->team2_cards =  $count_cardT2 ;
		$match->save();
		return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');
	}
	public function goal(Request $request)
	{
		$goal = new Goal;
		$goal->player_id          =$request->player_id;
		$goal->match_id           =$request->matchid;
		$goal->team_id            =$request->team_id;
		$goal->championship_id    =$request->championship_id;
		$goal->inteam_id          =$request->inteam_id;
		$goal->type               =$request->type;
		$goal->time                =date('H:i:s');
		$goal->save();
		$count_goalT1 = $goal->where('match_id',$request->matchid)->where('team_id',$request->T1)->count();
		$count_goalT2 = $goal->where('match_id',$request->matchid)->where('team_id',$request->T2)->count();
		$match = new Match;
		$match = $match->where('id',$request->matchid )->first();
		$match->team1_goals =  $count_goalT1 ;
		$match->team2_goals =  $count_goalT2 ;
		$match->save();
		return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');
	}

	public function save(Request $request)
	{
		$team1_id = $request->T1;
		$team2_id = $request->T2;
		$match_id = $request->match_id;
		$match    = new Match;
	  $team1_championship = Team_championship::where('team_id',$team1_id)->first();
		$team2_championship2 = Team_championship::where('team_id',$team2_id)->first();
		$championship_id = $match->where('id',$match_id)->first();
		$t1goals = $match->where('team1_id',$team1_id)->first(['team1_goals']);
		$t2goals = $match->where('team2_id',$team2_id)->first(['team2_goals']);
		$team1_id             = $request->T1;
		$team2_id             = $request->T2;
		$match_id             = $request->match_id;
		$match                = new Match;
	  	$team1_championship   = Team_championship::where('team_id',$team1_id)->first();
		$team2_championship2  = Team_championship::where('team_id',$team2_id)->first();
		$championship_id = $match->where('id',$match_id)->first();
		if(!isset($championship_id))
		{
				$t1goals = $match->where('team1_id',$team1_id)->first(['team1_goals']);
				$t2goals = $match->where('team2_id',$team2_id)->first(['team2_goals']);
	        if(count($team1_championship) > 0)
	        {
	        	$team1_championship->team_id = $team1_id;
	        	$team1_championship->championship_id =$championship_id->champion_id;
	        if(count($team2_championship2) > 0)
	        {
	        	$team2_championship2->team_id = $team2_id;
	        	$team2_championship2->championship_id =$championship_id->champion_id;
	        }
	        else
	        {
	        	$team2_championship2 = new Team_championship;
	        	$team2_championship2->team_id = $team2_id;
	        	$team2_championship2->championship_id =$championship_id->champion_id;
	        }
	        if($t1goals->team1_goals == $t2goals->team2_goals){
	        	$team1_championship->no_goals += $t1goals->team1_goals;
	        	$team1_championship->no_points += 1;
	        	$team1_championship->no_draughts += 1;
	        	$team1_championship->no_winnes += 0;
	        	$team1_championship->no_loses += 0;
	        	$team1_championship->save();
	        	$team2_championship2->no_goals += $t2goals->team2_goals;
	         	$team2_championship2->no_points += 1;
	        	$team2_championship2->no_draughts += 1;
	        	$team2_championship2->no_winnes += 0;
	        	$team2_championship2->no_loses += 0;
	        	$team2_championship2->save();
	       		}
	       	else if($t1goals->team1_goals > $t2goals->team2_goals){
	        	$team1_championship->no_goals += $t1goals->team1_goals;
	        	$team1_championship->no_points += 3;
	        	$team1_championship->no_draughts += 0;
	        	$team1_championship->no_winnes += 1;
	        	$team1_championship->no_loses += 0;
	        	$team1_championship->save();
			    $team2_championship2->no_goals += $t2goals->team2_goals;
	  			$team2_championship2->no_points += 0;
	  			$team2_championship2->no_draughts += 0;
	 			$team2_championship2->no_winnes += 0;
	 			$team2_championship2->no_loses += 1;
	 			$team2_championship2->save();
	      		}
	        else
	        {
	        	$team1_championship->no_goals += $t1goals->team1_goals;
	        	$team1_championship->no_points += 0;
	        	$team1_championship->no_draughts += 0;
	        	$team1_championship->no_winnes += 0;
	        	$team1_championship->no_loses += 1;
	        	$team1_championship->save();
	       		$team2_championship2->no_goals += $t2goals->team2_goals;
	       		$team2_championship2->no_points += 3;
	      		$team2_championship2->no_draughts += 0;
	        	$team2_championship2->no_winnes += 1;
	        	$team2_championship2->no_loses += 0;
	        	$team2_championship2->save();
	        }
	        }
    	}
        else
        {

	        	$team1_championship = new Team_championship;
	        	$team1_championship->team_id = $team1_id;
	        	$team1_championship->championship_id =$championship_id->champion_id;
	        if(count($team2_championship2) > 0)
	        {
	        	$team2_championship2->team_id = $team2_id;
	        	$team2_championship2->championship_id =$championship_id->champion_id;
	        }
	        else
	       	{
	        	$team2_championship2 = new Team_championship;
	        	$team2_championship2->team_id = $team2_id;
	        	$team2_championship2->championship_id =$championship_id->champion_id;
	        }
	        if($t1goals->team1_goals == $t2goals->team2_goals)
	        {
	        	$team1_championship->no_goals += $t1goals->team1_goals;
	        	$team1_championship->no_points += 1;
	        	$team1_championship->no_draughts += 1;
	        	$team1_championship->no_winnes += 0;
	        	$team1_championship->no_loses += 0;
	        	$team1_championship->save();
	        	$team2_championship2->no_goals += $t2goals->team2_goals;
	         	$team2_championship2->no_points += 1;
	        	$team2_championship2->no_draughts += 1;
	        	$team2_championship2->no_winnes += 0;
	        	$team2_championship2->no_loses += 0;
	        	$team2_championship2->save();
	       	}
	       	else if($t1goals->team1_goals > $t2goals->team2_goals)
	       	{
	        	$team1_championship->no_goals += $t1goals->team1_goals;
	        	$team1_championship->no_points += 3;
	        	$team1_championship->no_draughts += 0;
	        	$team1_championship->no_winnes += 1;
	        	$team1_championship->no_loses += 0;
	        	$team1_championship->save();
			    $team2_championship2->no_goals += $t2goals->team2_goals;
	  			$team2_championship2->no_points += 0;
	  			$team2_championship2->no_draughts += 0;
	 			$team2_championship2->no_winnes += 0;
	 			$team2_championship2->no_loses += 1;
	 			$team2_championship2->save();
	      	}
	        else
	        {
	        	$team1_championship->no_goals += $t1goals->team1_goals;
	        	$team1_championship->no_points += 0;
	        	$team1_championship->no_draughts += 0;
	        	$team1_championship->no_winnes += 0;
	        	$team1_championship->no_loses += 1;
	        	$team1_championship->save();
	       		$team2_championship2->no_goals += $t2goals->team2_goals;
	       		$team2_championship2->no_points += 3;
	      		$team2_championship2->no_draughts += 0;
	        	$team2_championship2->no_winnes += 1;
	        	$team2_championship2->no_loses += 0;
	        	$team2_championship2->save();
	        }
	    }
		return view('Editor.finish');
<<<<<<< HEAD
  //       	$team2_championship2 = new Team_championship;
  //       	$team2_championship2->team_id = $team2_id;
  //       	$team2_championship2->championship_id =$championship_id->champion_id;
  //       }
  //       if($t1goals->team1_goals == $t2goals->team2_goals){
  //       	$team1_championship->no_goals += $t1goals->team1_goals;
  //       	$team1_championship->no_points += 1;
  //       	$team1_championship->no_draughts += 1;
  //       	$team1_championship->no_winnes += 0;
  //       	$team1_championship->no_loses += 0;
  //       	$team1_championship->save();
  //       	$team2_championship2->no_goals += $t2goals->team2_goals;
  //        	$team2_championship2->no_points += 1;
  //       	$team2_championship2->no_draughts += 1;
  //       	$team2_championship2->no_winnes += 0;
  //       	$team2_championship2->no_loses += 0;
  //       	$team2_championship2->save();
  //      		}
  //      	else if($t1goals->team1_goals > $t2goals->team2_goals){
  //       	$team1_championship->no_goals += $t1goals->team1_goals;
  //       	$team1_championship->no_points += 3;
  //       	$team1_championship->no_draughts += 0;
  //       	$team1_championship->no_winnes += 1;
  //       	$team1_championship->no_loses += 0;
  //       	$team1_championship->save();
	// 	    $team2_championship2->no_goals += $t2goals->team2_goals;
  // 			$team2_championship2->no_points += 0;
  // 			$team2_championship2->no_draughts += 0;
 // 			$team2_championship2->no_winnes += 0;
 // 			$team2_championship2->no_loses += 1;
 // 			$team2_championship2->save();
  //     		}
  //       else
  //       {
  //       	$team1_championship->no_goals += $t1goals->team1_goals;
  //       	$team1_championship->no_points += 0;
  //       	$team1_championship->no_draughts += 0;
  //       	$team1_championship->no_winnes += 0;
  //       	$team1_championship->no_loses += 1;
  //       	$team1_championship->save();
  //      		$team2_championship2->no_goals += $t2goals->team2_goals;
  //      		$team2_championship2->no_points += 3;
  //     		$team2_championship2->no_draughts += 0;
  //       	$team2_championship2->no_winnes += 1;
  //       	$team2_championship2->no_loses += 0;
  //       	$team2_championship2->save();
  //       }
  //       }
  //       else
  //       {
  //       	$team1_championship = new Team_championship;
  //       	$team1_championship->team_id = $team1_id;
  //       	$team1_championship->championship_id =$championship_id->champion_id;
  //       if(count($team2_championship2) > 0)
  //       {
  //       	$team2_championship2->team_id = $team2_id;
  //       	$team2_championship2->championship_id =$championship_id->champion_id;
  //       }
  //       else
  //      	{
  //       	$team2_championship2 = new Team_championship;
  //       	$team2_championship2->team_id = $team2_id;
  //       	$team2_championship2->championship_id =$championship_id->champion_id;
  //       }
  //       if($t1goals->team1_goals == $t2goals->team2_goals)
  //       {
  //       	$team1_championship->no_goals += $t1goals->team1_goals;
  //       	$team1_championship->no_points += 1;
  //       	$team1_championship->no_draughts += 1;
  //       	$team1_championship->no_winnes += 0;
  //       	$team1_championship->no_loses += 0;
  //       	$team1_championship->save();
  //       	$team2_championship2->no_goals += $t2goals->team2_goals;
  //        	$team2_championship2->no_points += 1;
  //       	$team2_championship2->no_draughts += 1;
  //       	$team2_championship2->no_winnes += 0;
  //       	$team2_championship2->no_loses += 0;
  //       	$team2_championship2->save();
  //      	}
  //      	else if($t1goals->team1_goals > $t2goals->team2_goals)
  //      	{
  //       	$team1_championship->no_goals += $t1goals->team1_goals;
  //       	$team1_championship->no_points += 3;
  //       	$team1_championship->no_draughts += 0;
  //       	$team1_championship->no_winnes += 1;
  //       	$team1_championship->no_loses += 0;
  //       	$team1_championship->save();
	// 	    $team2_championship2->no_goals += $t2goals->team2_goals;
  // 			$team2_championship2->no_points += 0;
  // 			$team2_championship2->no_draughts += 0;
 // 			$team2_championship2->no_winnes += 0;
 // 			$team2_championship2->no_loses += 1;
 // 			$team2_championship2->save();
  //     	}
  //       else
  //       {
  //       	$team1_championship->no_goals += $t1goals->team1_goals;
  //       	$team1_championship->no_points += 0;
  //       	$team1_championship->no_draughts += 0;
  //       	$team1_championship->no_winnes += 0;
  //       	$team1_championship->no_loses += 1;
  //       	$team1_championship->save();
  //      		$team2_championship2->no_goals += $t2goals->team2_goals;
  //      		$team2_championship2->no_points += 3;
  //     		$team2_championship2->no_draughts += 0;
  //       	$team2_championship2->no_winnes += 1;
  //       	$team2_championship2->no_loses += 0;
  //       	$team2_championship2->save();
  //       }
  //       }
	// 	 	return view('Editor.finish');
	//
	// }
	// 	

=======

	}


>>>>>>> d02ae5b1b60c71dd9b40b432ed7c0268101f6b97

	public function edit($id)
	{
		//
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}
}
