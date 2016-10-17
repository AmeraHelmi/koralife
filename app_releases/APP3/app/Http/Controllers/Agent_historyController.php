<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Agent_history;
use App\Models\Player;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;

class Agent_historyController extends Controller {

	/**
	 * Display a listing of the resource.
	
	 * @return Response
	 */
	public function __construct()
	{
		 $this->middleware('auth');
	}
/**
		* @method [return Response] [index]([[obj] [$agent_history],[obj] [$request]])
		* [<it get data from two tables in db so we make join between player and agent >]
		*@param [obj] [$agent_history]
		*@param [obj] [$request]
		*@var [array] [$agent_histories] [<array of data [agent_historyID,agent_name,player_name,from_date,to_date] >]
		*@var [array] [$agents] [<description>]
		*@var [array] [$players] [<description>]
		*@uses [Agent_history Model,Request Model] 
		*@return [view 'agent_history.index'] 
*/

	public function index(Agent_history $agent_history , Request $request)
	{
	 		$agent_histories = $agent_history
		 								->join('agents as agent', 'agent.id', '=', 'agent_histories.agent_id')
		 								->join('players as player', 'player.id', '=', 'agent_histories.player_id')
		 								->select(array('agent_histories.id as agent_historyID',
																	'agent.name as agent_name',
																  'player.name as player_name',
		 														  'agent_histories.from_date as from_date',
																	'agent_histories.to_date as to_date'))
										->orderBy('agent_historyID')->get();

		 	$tableData = Datatables::of($agent_histories)
			 							->addColumn('actions', function ($data)
				 						{
											return view('partials.actionBtns')->with('controller','agent_history')->with('id', $data->agent_historyID)->render();
										});

		 	if($request->ajax())
			 	return DatatablePresenter::make($tableData, 'index');
			 	$agents=Agent::lists('name','id');
			 	$players=Player::lists('name','id');
	 	 		return view('agent_history.index')
								->with('agents',$agents)->with('players',$players)
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
			 	*@method [return Response] [store]([[obj] [$request]]) 
			 	*[<it store data [agent_id,player_id,from_date,to_date] in DB >]
			 	*@param [obj] [$request]
				*@var [obj] [$agent_history]
				*@uses [Request Model] 
			 	* @return Response
			 */
	public function store(Request $request)
 	{
 	 		$agent_history = new Agent_history;
 	 		$agent_history->agent_id          =$request->agent_id;
 	 		$agent_history->player_id         =$request->player_id;
 	 		$agent_history->from_date         =$request->from_date;
 	 		$agent_history->to_date           =$request->to_date;
 	 		$agent_history->save();
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
			 	*@method [return Response] [edit]([[obj] [$request],[int] [$id]]) 
				*[<to edit the form data >]
			 	* @param  int  $id
			 	*@var $agent_history <save in it id of agent_history which we need to edit>
			 	* @return Response
			 */
	public function edit(Request $request , $id)
  {
 	 		$agent_history= Agent_history::find($id);
 	 		if($request->ajax())
			{
 		 	return response(array('msg' => 'Adding Successfull', 'data'=> $agent_history->toJson() ), 200)
 							 ->header('Content-Type', 'application/json');
 		 }
  }

			/**
			 *Update
			 *@method [return Response] [update]([[obj] [$request],[int] [$id]]) 
			 *[<Update the specified resource in storage>]
			 * @param  int  $id
			 *@param  obj $request
			 *@var $agent_history <we store in it array of updated data >
			 * @return Response
			 */
	public function update(Request $request , $id)
	{
		$agent_history= Agent_history::find($id);
		$agent_history->agent_id          =$request->agent_id;
	  	$agent_history->player_id         =$request->player_id;
	  	$agent_history->from_date         =$request->from_date;
	  	$agent_history->to_date           =$request->to_date;
	  	$agent_history->save();
  		if($request->ajax())
			{
	  		return response(array('msg' => 'Adding Successfull'), 200)
						 ->header('Content-Type', 'application/json');
	 	  }
	}

			/**
			 * Remove the specified resource from storage.
			 *@method [return Response] [destroy]([[int] [$id]]) 
			 *[<to delete record>]
			 * @param  int  $id
			 *@var $agent_history <store record id>
			 * @return Response
			 */
 public function destroy($id)
  {
  	$agent_history= Agent_history::find($id);
	 $agent_history->delete();
 	  if($request->ajax())
		{
 		 	return response(array('msg' => 'Removing Successfull'), 200)
 							 ->header('Content-Type', 'application/json');
 		}
 	  return redirect()->back();
  }
}
/**
@copyright 2016 The PHP Team [Amera Helmi,Alaa Ragab,Lamess said]*/