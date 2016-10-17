<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Models\Team_player;
use App\Models\Team;
use App\Models\Player;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;

class TeamplayerController  extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function __construct()
 {
	 $this->middleware('auth');
 }
	public function index(Team_player $Team_player , Request $request)
	{
		$Team_player = $Team_player
	  	->join('teams as T', 'T.id', '=', 'team_players.team_id')
		  ->join('players as P', 'P.id', '=', 'team_players.player_id')
			->select(array('T.name as Tname', 'P.name as Pname', 'team_players.id as TPID'))
			->orderBy('TPID','desc')->get();

			$tableData = Datatables::of($Team_player)
				->addColumn('actions', function ($data)
					{return view('partials.actionBtns')->with('controller','playersteam')->with('id', $data->TPID)->render(); })
                    ;

			if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
				$teams=Team::where('is_team','like','نادى%')->lists('name','id');
				$players =Player::lists('name','id');

		return view('team_players.index')
		  ->with('teams',$teams)
		  ->with('players',$players)
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
	public function store(Request $request)
	{
        $count = count($request->player_id);


		for($i = 0 ; $i < $count ; $i++){
	$Team_player = new Team_player;
			$Team_player->team_id      = $request->team_id;
			$Team_player->player_id    = $request->player_id[$i];
			$Team_player->save();
		}

			return response(array('msg' => 'Adding Successfull'), 200)
								->header('Content-Type', 'application/json');
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
		$team_player 	= Team_player::find($id);
		if($request->ajax()){
			return response(array('msg' => 'Adding Successfull', 'data'=>$team_player->toJson() ), 200)
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
		$team_player =Team_player::find($id);

		$team_player->team_id          =$request->team_id;
		$team_player->save();

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
	$team_player 	= Team_player::find($id);

		$team_player->delete();
		if($request->ajax()){
			return response(array('msg' => 'Removing Successfull'), 200)
								->header('Content-Type', 'application/json');
			}
		return redirect()->back();
	}

}
