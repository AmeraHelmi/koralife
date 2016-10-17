<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Match;
use App\Models\Player_injured_history;
use App\Models\Team;
use App\Models\Player;
use App\Models\Team_player;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;

class Player_injured_historyController  extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
	   $this->middleware('auth');
	}
	public function index(Player_injured_history $Player_injured , Request $request)
	{
		$Player_injured = new Player_injured_history;
		$Player_injureds = $Player_injured
				->join('matches as M', 'M.id', '=', 'player_injured_histories.match_id')
				->join('teams as T1', 'T1.id', '=', 'M.team1_id')
				->join('teams as T2', 'T2.id', '=', 'M.team2_id')
				->join('players as P', 'P.id', '=', 'player_injured_histories.player_id')
				->select(array( 
					            'T1.name as T1name',
					            'T2.name as T2name',
								'player_injured_histories.id as Player_injured_id',
								'player_injured_histories.injured_name as Player_injured_name',
								'player_injured_histories.from_date as Player_injured_from',
								'player_injured_histories.to_date as Player_injured_to',
								'P.name as P_name'
				            ))
				 ->where('M.date',date('Y-m-d'))->orderBy('Player_injured_id','asc')->get();

	 	$tableData = Datatables::of($Player_injureds)
	 			->editColumn('T1name', '{{$T1name}} - {{$T2name}}')
				->addColumn('actions', function ($data)
					{
return view('partials.actionBtns')->with('controller','Player_injured_history')->with('id', $data->Player_injured_id)->render(); 
                    });

	 	if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
			$match= new Match;
						$matches  = $match
						->join('teams as team1', 'team1.id', '=', 'matches.team1_id')
						->join('teams as team2', 'team2.id', '=', 'matches.team2_id')
						->select(array('team1.name as team1_name','team2.name as team2_name','matches.id as matchid'))
->where('matches.date',date('Y-m-d'))->orderBy('matchid','asc')->get();

			return view('Player_injured_history.index')
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
 				echo'<option selected> اختار النادى</option>';
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
 		foreach($team_player as $row)
			{
 				$player_name=Player::where('id',$row->player_id)->get();
 				foreach($player_name as $row2){
                     echo'<option value='.$row2->id.'> '.$row2->name.' </option>';
 			}
 		}
 	}
	public function store(Request $request)
	{		
			$Player_injured = new Player_injured_history;
			$Player_injured->player_id      		= $request->player_id;
			$Player_injured->match_id    			= $request->match_id;
			$Player_injured->injured_name     		= $request->injured_name;
			$Player_injured->from_date     			= $request->from_date;
			$Player_injured->to_date    			= $request->to_date;
			$Player_injured->nature_of_medicine    	= $request->nature_of_medicine;
			$Player_injured->medicine_place    		= $request->medicine_place;
			$Player_injured->addition_info    		= $request->addition_info;
			$Player_injured->save();
		
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
		$Player_injured = Player_injured_history::find($id);
	 	session(['playerid'    => $Player_injured->player_id]);

		if($request->ajax())
		{
			return response(array('msg' => 'Adding Successfull', 'data'=>$Player_injured->toJson() ), 200)
			->header('Content-Type', 'application/json');
		}
	}

	
	public function update(Request $request , $id)
 	{

		$Player_injured =Player_injured_history::find($id);

			$Player_injured->match_id    			= $request->match_id;
			$Player_injured->injured_name     		= $request->injured_name;
			$Player_injured->from_date     			= $request->from_date;
			$Player_injured->to_date    			= $request->to_date;
			$Player_injured->nature_of_medicine    	= $request->nature_of_medicine;
			$Player_injured->medicine_place    		= $request->medicine_place;
			$Player_injured->addition_info    		= $request->addition_info;

          if($request->team_id == 0){
                  $Player_injured->player_id      		= session('playerid');
          }
          else{
                  $Player_injured->player_id      		= $request->player_id;
          }			

			$Player_injured->save();

 		if($request->ajax())
		{
 			return response(array('msg' => 'Adding Successfull'), 200)
 			->header('Content-Type', 'application/json');
 		}
 	}

	public function destroy($id)
	{
	   	$Player_injured 	= Player_injured_history::find($id);
		$Player_injured->delete();
		if($request->ajax())
		{
			return response(array('msg' => 'Removing Successfull'), 200)
			->header('Content-Type', 'application/json');
		}
		return redirect()->back();
	}

}
