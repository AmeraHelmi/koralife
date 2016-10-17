<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Team;
use App\Models\Sponsor;
use App\Models\Team_sponsor;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;


class Team_sponsorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function __construct()
 {
	 $this->middleware('auth');
 }
	 public function index(Team_sponsor $t_sponsor , Request $request)
	 {
		 $team_sponsors = $t_sponsor
			 ->join('teams as team','team.id','=','team_sponsors.team_id')
			 ->join('sponsors as sponsor','sponsor.id','=','team_sponsors.sponsor_id')

			 ->select(array(
						 	'team_sponsors.id as t_sponsorID',
					   		'team.name as team_name',
							'sponsor.name as sponsor_name'
							))

			 ->orderBy('team_sponsors.id','desc')->get();

			 $tableData = Datatables::of($team_sponsors)

				 ->addColumn('actions', function ($data)
					 {return view('partials.actionBtns')->with('controller','team_sponsor')->with('id', $data->t_sponsorID)->render(); }) ;

			 if($request->ajax())
				 return DatatablePresenter::make($tableData, 'index');
				//  $championships=Championship::lists('name','id');

				 $teams=Team::where('is_team','like','نادى%')->lists('name','id');

			   $sponsors =Sponsor::lists('name','id');
		 return view('team_sponsors.index')
		   ->with('teams',$teams)
			 ->with('sponsors',$sponsors)
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
 				$count = count($request->sponsor_id);


			for($i = 0 ; $i < $count ; $i++){
				$t_sponsor = new Team_sponsor;
				$t_sponsor->sponsor_id          =$request->sponsor_id[$i];
				$t_sponsor->team_id          =$request->team_id;
				$t_sponsor->save();
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
 		$t_sponsor 	= Team_sponsor::find($id);
 		if($request->ajax()){
 			return response(array('msg' => 'Adding Successfull', 'data'=> $t_sponsor->toJson() ), 200)
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
 		$count = count($request->sponsor_id);
			for($i = 0 ; $i < $count ; $i++){
				$t_sponsor = Team_sponsor::find($id);
				$t_sponsor->sponsor_id       =$request->sponsor_id[$i];
				$t_sponsor->team_id          =$request->team_id;
				$t_sponsor->save();
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
 		$t_sponsor	= Team_sponsor::find($id);
 		$t_sponsor->delete();
 		if($request->ajax()){
 			return response(array('msg' => 'Removing Successfull'), 200)
 								->header('Content-Type', 'application/json');
 			}
 		return redirect()->back();
 	}


}
