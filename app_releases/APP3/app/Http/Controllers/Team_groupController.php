<?php namespace App\Http\Controllers;
use App\Http\Requests;

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
		  ->join('teams as t', 't.id', '=', 'team_groups.team_id')
			$tableData = Datatables::of($team_groups)
         $championships = Championship::lists('name','id');
			 	$groups=Group::lists('name','id');
		return view('team_group.index')
		  ->with('teams',$teams)
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
	}
	// public function select_team(Request $request)

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