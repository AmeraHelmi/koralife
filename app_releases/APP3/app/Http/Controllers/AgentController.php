<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Agent;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class AgentController extends Controller {

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
			*@method [return view] [index]([[obj] [$agent],[obj] [$request]])


			*@method [return view] [index]([[obj] [$agent],[obj] [$request]])
			*[<to get data of agent [name,addition_info]>]
			*@param [obj] [$agent]
			*@param [obj] [$request]
			*@uses [Agent,Request Model]
			*@return [view] <'agent.index'>
			*/
	public function index(Agent $agent , Request $request)
	{
		$agents = $agent
				->select(array('id', 'name','addition_info'))
                ->orderBy('name')->get();
			$tableData = Datatables::of($agents)
						->addColumn('actions', function ($data)
									{
									  return view('partials.actionBtns')->with('controller','agent')
									       ->with('id', $data->id)->render();
									});
		if($request->ajax())
		    return DatatablePresenter::make($tableData, 'index');
		return view('agent.index')
			->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}


	public function create()
	{
	}

			/**
			* Store a newly created resource in storage.
			*@method [return response] [store]([[obj] [$request]])
			*[<to insert data in DB>]
			*@param [obj] [$request]
			*@var [obj] [$agent] [< data [name,addition_info]>]
			*@uses [Request Model]
			*@return [Response]
			 */
	public function store(Request $request)
	{
		  	$agent = new Agent;
			  $agent->name              =$request->name;
			  $agent->addition_info     =$request->addition_info;
			  $agent->save();
				 if($request->ajax())
				{
					return response(array('msg' => 'adding Successfull'), 200)
										->header('Content-Type', 'application/json');
				}
	}



	public function show()
	{
	}
				/**
			*@method [return response] [edit]([[obj] [$request],[int] [$id]])
			*[<to edit data >]
			*@param [obj] [$request]
			*@param [int] [$id]
			*@var [int] [$agent]
			*@uses [Request Model]
			*@return [response]
			 */
	public function edit(Request $request , $id)
	{
		  $agent= Agent::find($id);
			if($request->ajax())
			{
			     return response(array('msg' => 'Adding Successfull', 'data'=> $agent->toJson() ), 200)
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
		 $agent= Agent::find($id);
		 $agent->name 	           = $request->name ;
		 $agent->addition_info     =$request->addition_info;
		 $agent->save();
		 return response(array('msg' => 'Adding Successfull'), 200)
							->header('Content-Type', 'application/json');
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
		$agent 	= Agent::find($id);
		$agent->delete();
		if($request->ajax())
		{
			return response(array('msg' => 'Removing Successfull'), 200)
								->header('Content-Type', 'application/json');
		}
		return redirect()->back();
	}

}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/
