<?php namespace App\Http\Controllers;
use App\Http\Requests;use App\Models\User;use App\Models\Team;use App\Models\Group;use App\Models\Championship;use App\Models\Team_group;use App\Http\Controllers\Controller;use yajra\Datatables\Datatables as Datatables;use Illuminate\Http\Request;use Illuminate\Routing\Router as Route;use App\Services\DatatablePresenter;use Auth;

class Team_groupController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function __construct()
	 {
		 $this->middleware('auth');
	 }
	public function index(Team_group $tgroup , Request $request)
	{
		$team_groups = $tgroup
		  ->join('teams as t', 't.id', '=', 'team_groups.team_id')		  ->join('championships as c', 'c.id', '=', 'team_groups.champion_id')			->select(array(				 'team_groups.id as tgID',				 't.name as team_name',         'c.name as Championship'			 ))			->orderBy('team_groups.id','desc')->get();
			$tableData = Datatables::of($team_groups)				->addColumn('actions', function ($data)					{return view('team_group/partial.actionBtns')->with('controller','team_group')->with('id', $data->tgID)->render(); })				;			if($request->ajax())				return DatatablePresenter::make($tableData, 'index');				 $nations=Team::where('is_team','like','منتخب%')->lists('name','id');				 $teams=Team::where('is_team','like','نادى%')->lists('name','id');
         $championships = Championship::lists('name','id');
			 	$groups=Group::lists('name','id');
		return view('team_group.index')
		  ->with('teams',$teams)		  ->with('nations',$nations)		  ->with('championships',$championships)		  ->with('groups',$groups)			->with('tableData', DatatablePresenter::make($tableData, 'index'));
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
	public function store(Request $request)	{$count = count($request->team_id);if($request->champ_type == 'دورى'){for($i = 0 ; $i < $count ; $i++){		$tgroup = new Team_group;		$tgroup->champion_id        =$request->champion_id;		$tgroup->team_id            = $request->team_id[$i];	  $tgroup->save();	}}else{			for($i = 0 ; $i < $count ; $i++){		$tgroup = new Team_group;		$tgroup->group_id           =$request->group_id;		$tgroup->role               =$request->role;		$tgroup->champion_id        =$request->champion_id;		$tgroup->team_id            = $request->team_id[$i];	  $tgroup->save();	}}			return response(array('msg' => 'Adding Successfull'), 200)								->header('Content-Type', 'application/json');
	}	//
	// public function select_team(Request $request)	//  {	//	// 		 $team_type = $request->team_type;	// 		 $teams = Team::where('is_team','like',$team_type)->get();	//	// 			foreach($teams as $row)	// 			{	// 				echo'<option value='.$row->id.'> '.$row->name.' </option>';	// 			}	//  }

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
		$tgroup 	= Team_group::find($id);
		if($request->ajax()){
			return response(array('msg' => 'Adding Successfull', 'data'=> $tgroup->toJson() ), 200)
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
		$tgroup 	= Team_group::find($id);
 		$tgroup->team_id     =$request->team_id;
		$tgroup->group_id    =$request->group_id;
		$tgroup->role        =$request->role;
		$tgroup->save();

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
		$tgroup 	= Team_group::find($id);
		$tgroup->delete();
		if($request->ajax()){
			return response(array('msg' => 'Removing Successfull'), 200)
								->header('Content-Type', 'application/json');
			}
		return redirect()->back();
	}

}
