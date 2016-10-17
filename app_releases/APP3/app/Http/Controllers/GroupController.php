<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Input;
use Auth;
use App\Models\Group;
use App\Models\Championship;

class GroupController extends Controller {

			/**
			 * Display a listing of the resource.
			 *
			 * @return Response
			 */
	public function __construct()
	{
				$this->middleware('auth');
	}
			/**
			*@method [return view] [index]([[obj] [$group],[obj] [$request]]) 
			*[<to get data of Group>]
			*@param [obj] [$group] 
			*@param [obj] [$request] 
			*@uses [Group,Request Model] 
			*@return [view] <'group.index'>
			*/
	public function index(Group $group , Request $request)
	{
				$groups = $group
						->join('championships as championship', 'championship.id', '=', 'groups.championship_id')
						->select(array('groups.id as groupID', 'groups.name as group_name','championship.name as championship_name','groups.addition_info as addition_info','groups.no_matches as no_matches'))
						->orderBy('championship.name')->get();

				$tableData = Datatables::of($groups)
						->addColumn('actions', function ($data)
							{
						return view('partials.actionBtns')->with('controller','group')->with('id', $data->groupID)->render(); }) ;

		if($request->ajax())
			return DatatablePresenter::make($tableData, 'index');
			$championships=Championship::lists('name','id');
		 	return view('group.index')
						->with('championships',$championships)
						->with('tableData', DatatablePresenter::make($tableData, 'index'));
	 }

	
	public function create()
	{
		//
	}

			/**
			* Store a newly created resource in storage.
			*@method [return response] [store]([[obj] [$request]]) 
			*[<to insert data in DB>]
			*@param [obj] [$request] 
			*@var [obj] [$group] 
			*@uses [Group,Request Model]
			*@return [Response]
			*/
	public function store(Request $request)
 	{

 				$group = new Group;
				$group->championship_id    =$request->championship_id;
				$group->name               =$request->name;
				$group->addition_info      =$request->addition_info;
				$group->no_matches         =$request->no_matches;
 				$group->save();
 				return response(array('msg' => 'Adding Successfull'), 200)
 								->header('Content-Type', 'application/json');
 	}



	public function show($id)
	{
		//
	}

			/**
			*@method [return response] [edit]([[obj] [$request],[int] [$id]]) 
			*[<to edit data >]
			*@param [obj] [$request] 
			*@param [int] [$id] 
			*@var [obj] [$group]
			*@uses [Group,Request Model] 
			*@return [response]
			*/
	public function edit(Request $request , $id)
 	{
 			$group= Group::find($id);
 			if($request->ajax()){
 			return response(array('msg' => 'Adding Successfull', 'data'=> $group->toJson() ), 200)
 			->header('Content-Type', 'application/json');
 			}
 	}
			/**
			 * Update the specified resource in storage.
			 **@method [return response] [update]([obj] [$request],[int] [$id]) 
			 *[<to update data >]
			 * @param  obj  $request
			 * @param  int  $id
			 * @return Response
			*/
	public function update(Request $request , $id)
  	{
	   		$group= Group::find($id);
				$group->championship_id    =$request->championship_id;
				$group->name               =$request->name;
				$group->addition_info      =$request->addition_info;
				$group->no_matches         =$request->no_matches;
	 			$group->save();
	 			if($request->ajax()){
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
	 		$group= Group::find($id);
	 		$group->delete();
	 		if($request->ajax()){
	 			return response(array('msg' => 'Removing Successfull'), 200)
	 							->header('Content-Type', 'application/json');
	 			}
	 		return redirect()->back();
	 	}

}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/