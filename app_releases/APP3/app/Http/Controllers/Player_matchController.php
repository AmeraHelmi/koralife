<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Match;
use App\Models\Player_match;
use App\Models\Team_player;
use App\Models\Team;
use App\Models\Player;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;

class Player_matchController  extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
	   $this->middleware('auth');
	}
	public function index(Player_match $player_match , Request $request)
	{
		$Allmatch= new Match;
		$Allmatch = $Allmatch
				->join('teams as T1', 'T1.id', '=', 'matches.team1_id')
				->join('teams as T2', 'T2.id', '=', 'matches.team2_id')
				->select(array('T1.name as T1name','T2.name as T2name',
								'matches.id as match_id',
								'matches.team1_goals as team1_goals',
								'matches.team2_goals as team2_goals',
								'matches.match_date as match_date',
								'T1.flag as T1flag',
								'T2.flag as T2flag',
								'T1.id as T1ID',
								'T2.id as T2ID'
				            ))
				 ->where('date',date('Y-m-d'))->orderBy('match_id','desc')->get();

	 	$player_matches = $player_match
	  			->join('teams as T', 'T.id', '=', 'player_matches.team_id')
				->join('matches as M', 'M.id', '=', 'player_matches.match_id')
		  		->join('players as P', 'P.id', '=', 'player_matches.player_id')
				->select(array('T.name as Tname',
			 					'P.name as Pname',
			  					'player_matches.id as PMID',
								'player_matches.to_time as to_time',
								'player_matches.from_time as from_time'))
				->orderBy('PMID','desc')->get();

	 	$tableData = Datatables::of($player_matches)
				->addColumn('actions', function ($data)
					{
					return view('player_match/partial.actionBtns')->with('controller','player_match')->with('id', $data->PMID)->render(); });

	 	if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
				$teams   =Team::lists('name','id');
				$players =Player::lists('name','id');

				$match= new Match;
				$matches  = $match
				->join('teams as team1', 'team1.id', '=', 'matches.team1_id')
				->join('teams as team2', 'team2.id', '=', 'matches.team2_id')
				->select(array('team1.name as team1_name','team2.name as team2_name','matches.id as matchid'))
				 ->where('date',date('Y-m-d'))->orderBy('matchid','desc')->get();

			  	return view('player_match.index')
				->with('teams',$teams)
				->with('Allmatch',$Allmatch)
				->with('players',$players)
				->with('matches',$matches)
				->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}


	public function create()
	{
		//
	}


	public function getteams(Request $request)
 	{
 		$match_id = $request->match_id;
 		$teams = Match::where('id',$match_id)->get();
 		foreach($teams as $row)
			{
 				$team1_name=Team::where('id',$row->team1_id)->get(['name','id']);
 				$team2_name=Team::where('id',$row->team2_id)->get(['name','id']);
 		foreach ($team1_name as $t1name)
			{
 			 	echo'<option value='.$t1name->id.'> '. $t1name->name.' </option>';
 			}
 		foreach ($team2_name as $t2name)
			{
 			 	echo'<option value='.$t2name->id.'> '. $t2name->name.' </option>';
 			}
 		  	}

 	}

 	public function getplayers(Request $request)
 	{
 		$team_id = $request->team_id;
 		$team_player = Team_player::where('team_id',$team_id)->get();
 		$i=0;
 		echo'<div class="checkbox">';
 		foreach($team_player as $row)
			{
 		 		$i++;
 				$player_name=Player::where('id',$row->player_id)->get(['name']);
 				foreach($player_name as $row2){
  				echo '<label style="padding-right: 15px;"><input  type="checkbox" value='.$row->player_id.' name="player_id[]">'.$row2->name.'</label>';
  				if($i == 4)
  				{
 	 				echo '<br>';
 	 				$i=0;
  				}
 												}
 			}
 		echo '</div>';
 	}
	public function store(Request $request)
	{
        $count = count($request->player_id);
		for($i = 0 ; $i < $count ; $i++)
		{
			$player_match = new Player_match;
			$player_match->team_id      = $request->team_id;
			$player_match->player_id    = $request->player_id[$i];
			$player_match->match_id     = $request->match_id;
			$player_match->to_time      = $request->to_time;
			$player_match->from_time    = $request->from_time;
			$player_match->save();
		}
		if($request->ajax())
		{
			return response(array('msg' => 'Adding Successfull'), 200)
			->header('Content-Type', 'application/json');
		}
	}


	public function show($id)
	{
		//
	}


	public function edit(Request $request , $id)
	{
		$player_match 	= player_match::find($id);
		if($request->ajax())
		{
			return response(array('msg' => 'Adding Successfull', 'data'=>$player_match->toJson() ), 200)
			->header('Content-Type', 'application/json');
		}
	}


	public function update(Request $request , $id)
 	{
		$player_match =Player_match::find($id);
		$player_match->team_id          =$request->team_id;
		$player_match->to_time     		= $request->to_time;
		$player_match->from_time        = $request->from_time;
		$player_match->save();
 		if($request->ajax())
		{
 			return response(array('msg' => 'Adding Successfull'), 200)
 			->header('Content-Type', 'application/json');
 		}
 	}

	public function destroy($id)
	{
	   	$player_match 	= Player_match::find($id);
		$player_match->delete();
		if($request->ajax())
		{
			return response(array('msg' => 'Removing Successfull'), 200)
			->header('Content-Type', 'application/json');
		}
		return redirect()->back();
	}

}
