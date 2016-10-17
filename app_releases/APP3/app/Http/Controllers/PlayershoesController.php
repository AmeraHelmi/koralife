<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Match;
use App\Models\Shoe;
use App\Models\Player_match;
use App\Models\Team_player;
use App\Models\Team;
use App\Models\Players_shoe;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use DB;

class PlayershoesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
 	{
	 	$this->middleware('auth');
 	}
	public function index(Players_shoe $players_shoe , Request $request)
	{
		$players_shoes = $players_shoe
		   	->join('shoes as S',   'S.id', '=', 'players_shoes.shoes_id')
			->join('players as p', 'p.id', '=', 'players_shoes.player_id')
			->join('matches as M', 'M.id', '=', 'players_shoes.match_id')
			->join('teams as T1', 'T1.id', '=', 'M.team1_id')
			->join('teams as T2', 'T2.id', '=', 'M.team2_id')
			->select(array('players_shoes.id as PSID',
							'S.brand as Sbrand',
							'T1.name as T1name',
				 			'T2.name as T2name',
				 			'p.name as Pname'))
			->orderBy('PSID','desc')->get();

		$tableData = Datatables::of($players_shoes)
         	->editColumn('T1name', '{{ $T1name }} - {{ $T2name }}')
			->addColumn('actions', function ($data)
			{return view('partials.actionBtns')->with('controller','playershoes')->with('id', $data->PSID)->render(); });

		if($request->ajax())
			return DatatablePresenter::make($tableData, 'index');
		$shoes=Shoe::lists('brand','id');
		$teams=Team::lists('name','id');
		$match= new Match;
		$matches  = $match
			->join('teams as team1', 'team1.id', '=', 'matches.team1_id')
			->join('teams as team2', 'team2.id', '=', 'matches.team2_id')
			->select(array('team1.name as team1_name','team2.name as team2_name','matches.id as matchid'))
			->get();

		return view('player_shoes.index')
		   	->with('shoes',$shoes)
		   	->with('teams',$teams)
			->with('matches',$matches)
			->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}


	 //get all city
	public function getplayers(Request $request)
	{
		$team_id = $request->team_id;
		$team_player = Team_player::where('team_id',$team_id)->get();
		foreach($team_player as $row)
		{
		$player_name=Player::where('id',$row->player_id)->get(['name']);
		foreach($player_name as $row2)
		{
			echo'<option value='.$row->player_id.'> '.$row2->name.' </option>';
		}
		}

	}

	public function create()
	{
		//
	}

	 public function store(Request $request)
 	{
		$players_shoe = new Players_shoe;
		$players_shoe->shoes_id           =$request->shoes_id;
		$players_shoe->match_id           =$request->match_id;
		$players_shoe->player_id          =$request->player_id;
		$players_shoe->save();
		return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');
	}


	
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
		$players_shoe= Players_shoe::find($id);

		if($request->ajax()){
			return response(array('msg' => 'Adding Successfull', 'data'=> $players_shoe->toJson() ), 200)
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
		$players_shoe= Players_shoe::find($id);
		$players_shoe->shoes_id           =$request->shoes_id;
		$players_shoe->match_id           =$request->match_id;
		$players_shoe->player_id          =$request->player_id;
		$players_shoe->save();

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
 		$players_shoe	= Players_shoe::find($id);
 		$players_shoe->delete();
 		if($request->ajax()){
 			return response(array('msg' => 'Removing Successfull'), 200)
 			->header('Content-Type', 'application/json');
 			}
 		return redirect()->back();
 	}


}
