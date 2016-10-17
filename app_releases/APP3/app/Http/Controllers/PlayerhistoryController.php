<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use App\Models\Player_historie;
use App\Models\Team;
use App\Models\Player;

class PlayerhistoryController extends Controller {

	
	public function __construct()
 	{
	 	$this->middleware('auth');
 	}
	public function index(Player_historie $player_historie , Request $request)
	{
		$player_historie = $player_historie
			->join('teams as T1', 'T1.id', '=', 'player_histories.from_team_id')
			->join('teams as T2', 'T2.id', '=', 'player_histories.to_team_id')
			->join('players as P', 'P.id', '=', 'player_histories.player_id')
			->select(array('P.name as Pname',
					  		'T1.name as T1name',
							'T2.name as T2name',
							'player_histories.from_date as FromDate',
							'player_histories.to_date as ToDate',
							'player_histories.contract_type as contract',
							'player_histories.contract_total as total',
							'player_histories.season_type as season',
							'player_histories.id as PHID'
						))
			->orderBy('PHID','desc')->get();

		$tableData = Datatables::of($player_historie)
			->addColumn('actions', function ($data)
			{
				return view('partials.actionBtns')->with('controller','playerhistory')->with('id', $data->PHID)->render(); });

		if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');

		$teams=Team::where('is_team','like','نادى%')->lists('name','id');
		$players  = Player::lists('name','id');
			return view('player_history.index')
			->with('teams',$teams)
			->with('players',$players)
			->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}


	public function create()
	{
		//
	}

	
	public function store(Request $request)
 	{

 		$player_historie = new Player_historie;
 		$player_historie->from_date          =$request->from_date;
		$player_historie->to_date            =$request->to_date;
		$player_historie->from_team_id       =$request->from_team_id;
		$player_historie->to_team_id         =$request->to_team_id;
		$player_historie->player_id          =$request->player_id;
		$player_historie->contract_type      =$request->contract_type;
		$player_historie->contract_total     =$request->contract_total;
		$player_historie->season_type        =$request->season_type;
 		$player_historie->addition_info        =$request->addition_info;
		$player_historie->save();
 		return response(array('msg' => 'Adding Successfull'), 200)
 		->header('Content-Type', 'application/json');
 	}


	
	public function show($id)
	{
		//
	}

	public function edit(Request $request , $id)
 	{
 		$player_historie= Player_historie::find($id);
 		if($request->ajax()){
 			return response(array('msg' => 'Adding Successfull', 'data'=> $player_historie->toJson() ), 200)
 			->header('Content-Type', 'application/json');
 							}
 	}

	
	public function update(Request $request , $id)
  	{
   		$player_historie= Player_historie::find($id);
	 	$player_historie->from_date          =$request->from_date;
	 	$player_historie->to_date            =$request->to_date;
	 	$player_historie->from_team_id       =$request->from_team_id;
	 	$player_historie->to_team_id         =$request->to_team_id;
	 	$player_historie->player_id          =$request->player_id;
	 	$player_historie->contract_type      =$request->contract_type;
	 	$player_historie->contract_total     =$request->contract_total;
	 	$player_historie->season_type        =$request->season_type;
	 	$player_historie->addition_info      =$request->addition_info;
 	 	$player_historie->save();
 	 	if($request->ajax()){
 			return response(array('msg' => 'Adding Successfull'), 200)
 			->header('Content-Type', 'application/json');
 				}
  	}

	
	public function destroy($id)
 	{
		$player_historie= Player_historie::find($id);
		$player_historie->delete();
		if($request->ajax()){
			return response(array('msg' => 'Removing Successfull'), 200)
		 	->header('Content-Type', 'application/json');
		 			}
		return redirect()->back();
	}

}
