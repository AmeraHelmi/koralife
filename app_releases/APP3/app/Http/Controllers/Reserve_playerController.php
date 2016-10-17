<?php namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Models\Match;
use App\Models\Reserve_player;
use App\Models\Team_player;
use App\Models\Team;
use App\Models\Player;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;

class Reserve_playerController  extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function __construct()
 {
	 $this->middleware('auth');
 }
	public function index(Reserve_player $reserve_player , Request $request)
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

		$reserve_players = $reserve_player
	  	->join('teams as T', 'T.id', '=', 'reserve_players.team_id')
			->join('matches as M', 'M.id', '=', 'reserve_players.match_id')
		  ->join('players as P', 'P.id', '=', 'reserve_players.player_id')
			->select(array('T.name as Tname', 'P.name as Pname', 'reserve_players.id as RPID'))
			->orderBy('RPID','desc')->get();

			$tableData = Datatables::of($reserve_players)
				->addColumn('actions', function ($data)
					{return view('reserve_player/partial.actionBtns')->with('controller','reserve_player')->with('id', $data->RPID)->render(); })
                    ;

			if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
				$teams   =Team::lists('name','id');
				$players =Player::lists('name','id');
				$match= new Match;
				$matches  = $match
			 		 ->join('teams as team1', 'team1.id', '=', 'matches.team1_id')
			 		 ->join('teams as team2', 'team2.id', '=', 'matches.team2_id')
			 		 ->select(array('team1.name as team1_name','team2.name as team2_name','matches.id as matchid'))
			 		 ->get();
		return view('reserve_player.index')
		  ->with('teams',$teams)
		  ->with('Allmatch',$Allmatch)
		  ->with('players',$players)
			->with('matches',$matches)
		  ->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	 public function getteams(Request $request)
	 {
		 $match_id = $request->match_id;
		 $teams = Match::where('id',$match_id)->get();

		 foreach($teams as $row){
			 $team1_name=Team::where('id',$row->team1_id)->get(['name','id']);
			 $team2_name=Team::where('id',$row->team2_id)->get(['name','id']);
			 foreach ($team1_name as $t1name) {
			 	echo'<option value='.$t1name->id.'> '. $t1name->name.' </option>';
			 }
			 foreach ($team2_name as $t2name) {
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
		 foreach($team_player as $row){
			$i++;
			 $player_name=Player::where('id',$row->player_id)->get(['name']);
				 foreach($player_name as $row2){
  echo '<label style="padding-right: 15px;"><input  type="checkbox" value='.$row->player_id.' name="player_id[]">'.$row2->name.'</label>';
	if($i == 6)
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


		for($i = 0 ; $i < $count ; $i++){
	$reserve_player = new Reserve_player;
			$reserve_player->team_id    = $request->team_id;
			$reserve_player->player_id    = $request->player_id[$i];
			$reserve_player->match_id    = $request->match_id;

			$reserve_player->save();
		}

		if($request->ajax()){
			return response(array('msg' => 'Adding Successfull'), 200)
								->header('Content-Type', 'application/json');
			}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request , $id)
	{
		$reserve_player 	= Reserve_player::find($id);
		if($request->ajax()){
			return response(array('msg' => 'Adding Successfull', 'data'=>$reserve_player->toJson() ), 200)
								->header('Content-Type', 'application/json');
			}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 public function update(Request $request , $id)
 	{
		$count = count($request->player_id);


for($i = 0 ; $i < $count ; $i++){
	$reserve_player =Reserve_player::find($id);
	$reserve_player->team_id    = $request->team_id;
	$reserve_player->player_id    = $request->player_id[$i];
	$reserve_player->match_id    = $request->match_id;

	$reserve_player->save();
}


 		if($request->ajax()){
 			return response(array('msg' => 'Adding Successfull'), 200)
 								->header('Content-Type', 'application/json');
 			}
 	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	$reserve_player 	= Reserve_player::find($id);

		$reserve_player->delete();
		if($request->ajax()){
			return response(array('msg' => 'Removing Successfull'), 200)
								->header('Content-Type', 'application/json');
			}
		return redirect()->back();
	}

}
