<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Match;
use App\Models\Player_match;
use App\Models\Team_player;
use App\Models\Championship;
use App\Models\Team;
use App\Models\Discussion;
use App\Models\Player;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;

class AnalysisController  extends Controller {

			/**
			 * Display a listing of the resource.
			 *@method [] [construct]([[] [no parameter]]) [<to checks if user login or not>]
			 * @return Response
			 */
public function __construct()
 {
	 $this->middleware('auth');
 }
 			/**
			*@method [return view] [index]([[obj] [$Discussion],[obj] [$request]])
			*[<to get data from 3 tables [matches,teams] in DB to get[Author,analysis_id,analysis_date,T1name,T2name] >]
			*@param [obj] [$Discussion]
			*@param [obj] [$request]
			*@uses [Discussion,Request Model]
			*@return [view] <'analysis.index'>
			*/

public function index(Discussion $Discussion , Request $request)
{
	$Discussion = $Discussion
				->join('matches as M', 'M.id', '=', 'discussions.match_id')
				->join('teams as T1', 'T1.id', '=', 'M.team1_id')
				->join('teams as T2', 'T2.id', '=', 'M.team2_id')
				->select(array(
					        'discussions.analysis as analysis',
			  					'discussions.id as analysis_id',
									'discussions.Author as Author',
      						'discussions.analysis_date as analysis_date',
									'T1.name as T1name',
									'T2.name as T2name'
								))
				->orderBy('analysis_id','desc')->get();
	$tableData = Datatables::of($Discussion)
			  ->editColumn('T1name', '{{ $T1name }} - {{ $T2name }}')
				->addColumn('actions', function ($data)
									{
										return view('partials.actionBtns')->with('controller','Analysis')->with('id', $data->analysis_id)->render();
									});

	if($request->ajax())
		return DatatablePresenter::make($tableData, 'index');
		$champions=Championship::lists('name','id');
		$match= new Match;
		$matches = $match
			 	->join('teams as team1', 'team1.id', '=', 'matches.team1_id')
			 	->join('teams as team2', 'team2.id', '=', 'matches.team2_id')
			 	->select(array('team1.name as team1_name',
					 							'team2.name as team2_name',
												'matches.id as matchid'))
			 	->get();
		return view('analysis.index')
		->with('matches',$matches)
		->with('championships',$champions)
		->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}

	public function get_match(Request $request)
	{
		 		$championship_id = $request->championship_id;
		    $matches = Match::where('champion_id','=',$championship_id)->get();
				echo'<option value="selected"> اختر مباراة</option>';
		 		foreach($matches as $row)
		 		{
						$team1_name=Team::where('id',$row->team1_id)->get(['name']);
 						$team2_name=Team::where('id',$row->team2_id)->get(['name']);
						$arr=array();
						foreach($team1_name as $tname)
						{
								$arr[0]=$tname->name;
						}
					  foreach($team2_name as $t2name)
					  {
						    $arr[1]=$t2name->name;
					  }
						echo'<option value='.$row->id.'> '. $arr[0] .'-'. $arr[1].' </option>';
				 }
	}

	public function create()
	{
		//
	}

			/**
			* Store a newly created resource in storage.
			**@method [return response] [store]([[obj] [$request]])
			*[<to store data >]
			*@param [obj] [$request]
			*@var [obj] [$Discussion]
			*@uses [Request Model]
			* @return Response
			*/
	public function store(Request $request)
	{
			$Discussion = new Discussion;
			$Discussion->match_id          = $request->match_id;
			$Discussion->analysis          = $request->analysis;
			$Discussion->Author            = Auth::user()->name;
			$Discussion->analysis_date     = $request->analysis_date;
			$Discussion->save();
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

			/**
			*@method [return response] [edit]([[obj] [$request],[int][$id]])
			*[<show data to edit  >]
			*@param [int] [$id]
			*@param [obj] [$request]
			*@var [obj] [$Discussion]
			*@uses [Request Model]
			*@return response
			*/
public function edit(Request $request , $id)
{
		$Discussion = Discussion::find($id);
		if($request->ajax())
		{
				return response(array('msg' => 'Adding Successfull', 'data'=>$Discussion->toJson() ), 200)
						->header('Content-Type', 'application/json');
		}
}

			/**
			 * Update the specified resource in storage.
			 **@method [return response] [update]([[obj] [$request],[int] [$id]])
			*[<to update data >]
			 * @param  int  $id
			 * @param  obj  $request
			 * @return Response
			 */

public function update(Request $request , $id)
 {
		$Discussion = Discussion::find($id);
		$Discussion->analysis          = $request->analysis;
		$Discussion->Author            = Auth::user()->name;
		$Discussion->analysis_date     = $request->analysis_date;
		$Discussion->save();
 		if($request->ajax())
		  {
 			 return response(array('msg' => 'Adding Successfull'), 200)
 							->header('Content-Type', 'application/json');
 		  }
 	}

			/**
			 * Remove the specified resource from storage.
			 *@method [return response] [destroy]([[int] [$id]])
			 *[<to delete data >]
			 * @param  int  $id
			 * @return Response
			 */
public function destroy($id)
{
		$Discussion = Discussion::find($id);
		$Discussion->delete();
		if($request->ajax())
		  {
			return response(array('msg' => 'Removing Successfull'), 200)
							->header('Content-Type', 'application/json');
		  }
		return redirect()->back();
	}
}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/
