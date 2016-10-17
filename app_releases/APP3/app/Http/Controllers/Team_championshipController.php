<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ball;
use App\Models\Coach;
use App\Models\Team;
use App\Models\Managment_championship;
use App\Models\Player;
use App\Models\Manager;
use App\Models\Sponsor;
use App\Models\Team_championship;
use App\Models\Championship;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;


class Team_championshipController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function __construct()
 {
	 $this->middleware('auth');
 }
	 public function index(Team_championship $t_champion , Request $request)
	 {
		 $team_championships = $t_champion
			 ->join('teams as team','team.id','=','team_championships.team_id')
			 ->join('championships as championship','championship.id','=','team_championships.championship_id')
			 ->join('coaches as coach','coach.id','=','team_championships.coach_id')

			 ->select(array(
				 'team_championships.id as t_championID',
			   'team.name as team_name',
				 'championship.name as championship_name',
				 'team_championships.no_goals as no_goals',
				 'team_championships.no_points as no_points',
				 'team_championships.no_draughts as no_draughts',
				 'team_championships.no_winnes as no_winnes',
				 'team_championships.no_loses as no_loses',
				 'coach.name as coach_name'



			 ))

			 ->orderBy('team_championships.id','desc')->get();

			 $tableData = Datatables::of($team_championships)

				 ->addColumn('actions', function ($data)
					 {return view('partials.actionBtns')->with('controller','team_championship')->with('id', $data->t_championID)->render(); })
				 ;

			 if($request->ajax())
				 return DatatablePresenter::make($tableData, 'index');
				//  $championships=Championship::lists('name','id');

				 $teams= Team::lists('name','id');
			   $championships =Championship::lists('name','id');
				 $coaches =Coach::lists('name','id');

		 return view('Team_championship.index')
		   ->with('teams',$teams)
			 ->with('championships',$championships)
			 ->with('coaches',$coaches)

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
		$t_champion = new Team_championship;
		$t_champion->team_id          =$request->team_id;
		$t_champion->championship_id          =$request->championship_id;
		$t_champion->coach_id        =$request->coach_id;
		$t_champion->no_goals        =$request->no_goals;
		$t_champion->no_winnes        =$request->no_winnes;
		$t_champion->no_loses        =$request->no_loses;
		$t_champion->no_draughts        =$request->no_draughts;
		$t_champion->no_points        =$request->no_points;

		$t_champion->save();


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
 		$t_champion 	= Team_championship::find($id);
 		if($request->ajax()){
 			return response(array('msg' => 'Adding Successfull', 'data'=> $t_champion->toJson() ), 200)
 								->header('Content-Type', 'application/json');
 			}
 	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 public function update(Request $request,$id)
	{
		$t_champion 	= Team_championship::find($id);
		$t_champion->team_id          =$request->team_id;
		$t_champion->championship_id          =$request->championship_id;
		$t_champion->coach_id        =$request->coach_id;
		$t_champion->no_goals        =$request->no_goals;
		$t_champion->no_winnes        =$request->no_winnes;
		$t_champion->no_loses        =$request->no_loses;
		$t_champion->no_draughts        =$request->no_draughts;
		$t_champion->no_points        =$request->no_points;

		$t_champion->save();


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
 		$t_champion	= Team_championship::find($id);
 		$t_champion->delete();
 		if($request->ajax()){
 			return response(array('msg' => 'Removing Successfull'), 200)
 								->header('Content-Type', 'application/json');
 			}
 		return redirect()->back();
 	}


}
