<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ball;
use App\Models\Group;
use App\Models\Team;
use App\Models\Match_referee;
use App\Models\Coach;
use App\Models\Manager;
use App\Models\Match;
use App\Models\Championship;
use App\Models\Team_history_coach;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;


class Team_history_coachController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
public function __construct()
{
	 $this->middleware('auth');
}

public function index(Team_history_coach $t_coach , Request $request)
{
		$team_history_coaches = $t_coach
			 											->join('teams as team','team.id','=','team_history_coaches.team_id')
			 											->join('coaches as coach','coach.id','=','team_history_coaches.coach_id')
			 											->select(array(
																 'team_history_coaches.id as tcoachID',
															   'team.name as team_name',
																 'coach.name as coach_name',
																 'team_history_coaches.from_date as from_date',
																 'team_history_coaches.to_date as to_date',
																 'team_history_coaches.contract as contract',
																 'team_history_coaches.addition_info as addition_info'
															))
														->orderBy('team_history_coaches.id','desc')->get();
		$tableData = Datatables::of($team_history_coaches)
													->addColumn('actions', function ($data)
					 								{
															return view('partials.actionBtns')->with('controller','team_history_coach')->with('id', $data->tcoachID)->render(); });
		if($request->ajax())
		return DatatablePresenter::make($tableData, 'index');
		$teams= Team::lists('name','id');
		$coaches =Coach::lists('name','id');
		return view('team_history_coach.index')
		   			->with('teams',$teams)
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
		$t_coach = new Team_history_coach;
		$t_coach->team_id          =$request->team_id;
		$t_coach->coach_id         =$request->coach_id;
		$present_checked = Input::get('present');
		if(is_array($present_checked)){
				$t_coach->to_date          =null;		
		}
		else {
				$t_coach->to_date          =$request->to_date;
}
		$t_coach->from_date        =$request->from_date;

		$t_coach->contract         =$request->contract;
		$t_coach->addition_info    =$request->addition_info;
		$t_coach->save();
		if($request->ajax())
		{
				return response(array('msg' => 'Adding Successfull'), 200)
									->header('Content-Type', 'application/json');
		}
}

public function select_team(Request $request)
 {
		$team_type = $request->team_type;
	  $teams = Team::where('is_team','like',$team_type)->get();
		foreach($teams as $row)
		{
				echo'<option value='.$row->id.'> '.$row->name.' </option>';
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
 		$t_coach 	= Team_history_coach::find($id);
		session(['team_id'    => $t_coach->team_id]);

 		if($request->ajax()){
 			return response(array('msg' => 'Adding Successfull', 'data'=> $t_coach->toJson() ), 200)
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
		$t_coach 	= Team_history_coach::find($id);
		if($request->team_id == 0)
		{
				$t_coach->team_id       =session('team_id');

		}
		else
		{
				$t_coach->team_id       =$request->team_id;
		}

		$t_coach->coach_id         =$request->coach_id;
		$t_coach->from_date        =$request->from_date;
		$t_coach->to_date          =$request->to_date;
		$t_coach->contract         =$request->contract;
	  $t_coach->addition_info    =$request->addition_info;
		$t_coach->save();
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
 		$t_coach	= Team_history_coach::find($id);
 		$t_coach->delete();
 		if($request->ajax()){
 			return response(array('msg' => 'Removing Successfull'), 200)
 								->header('Content-Type', 'application/json');
 			}
 		return redirect()->back();
}
}
