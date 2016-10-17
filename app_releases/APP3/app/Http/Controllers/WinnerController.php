<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Winner;
use App\Models\Team;
use App\Models\Championship;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class WinnerController extends Controller
{


	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Winner $winner , Request $request)
	{
		$winners = $winner
				->join('teams as team','team.id','=','winners.team_id')
				->join('championships as championship', 'championship.id', '=', 'winners.championship_id')
				->select(array(
								'team.name as team_name',
								'championship.name as championship_name',
								'winners.id as winners_id',
								'winners.win_date as winners_win_date',
								'winners.no_goals as winners_goals',
								'winners.no_points as winners_points',
								'winners.additional_info as winners_additional_info'
								))
				->orderBy('winners.id','asc')->get();
		$tableData = Datatables::of($winners)
				->addColumn('actions', function ($data)
				{
					return view('partials.actionBtns')->with('controller','match')->with('id', $data->winners_id)->render();
				});
					if($request->ajax())
					return DatatablePresenter::make($tableData, 'index');
				 	// $winners=Winner::lists('name','id');
					$teams= Team::lists('name','id');
					$championships = Championship::lists('name','id');
					return view('winner.index')
						->with('championships',$championships)
						->with('teams',$teams)
						->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}

public function create()
{
}
	/**

	 * Store a newly created resource in storage.

	 *

	 * @return Response

	 */
	public function select_team(Request $request)
	{
	 	$team_type = $request->team_type;
	 	$teams = Team::where('is_team','like',$team_type)->get();
		echo'<option value="selected">النادى الفائز بالبطوله </option>';
		foreach($teams as $row)
	 		{
	 			echo'<option value='.$row->id.'> '.$row->name.' </option>';
	 		}
	}
	public function store(Request $request)
	{
		$winner = new winner;
		$winner->team_id 			= $request->team_id ;
		$winner->championship_id 	= $request->championship_id ;
		$winner->win_date 			= $request->win_date ;
		$winner->no_goals 			= $request->no_goals ;
		$winner->no_points 			= $request->no_points ;
		$winner->additional_info 	= $request->additional_info ;
		$winner->save();
		return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');}


	public function show($id)
	{
	}


	public function edit(Request $request , $id)
	{
		$winner 	= winner::find($id);
		if($request->ajax())
		{
			return response(array('msg' => 'Adding Successfull', 'data'=> $winner->toJson() ), 200)
			->header('Content-Type', 'application/json');
 		}
	}

	public function update(Request $request, $id)
	{
		$winner = winner::find($id);
		$winner = new winner;
		$winner->team_id 			= $request->team_id ;
		$winner->championship_id 	= $request->championship_id ;
		$winner->win_date 			= $request->win_date ;
		$winner->no_goals 			= $request->no_goals ;
		$winner->no_points 			= $request->no_points ;
		$winner->additional_info 	= $request->additional_info ;
		$winner->save();
		if($request->ajax())
		{
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
		$winner	= winner::find($id);
		$winner->delete();
		if($request->ajax())
			{
				return response(array('msg' => 'Removing Successfull'), 200)
				->header('Content-Type', 'application/json');
      		}
		return redirect()->back();
 	}

}
