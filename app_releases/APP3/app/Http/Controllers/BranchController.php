<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Branch;
use App\Models\Team;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;


class BranchController extends Controller {

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
			*@method [return view] [index]([[obj] [$branch],[obj] [$request]])
			*[<to get data from 3 tables [countries,cities,teams] in DB to get[countryname,teamname,cityname] >]
			*@param [obj] [$branch]
			*@param [obj] [$request]
			*@uses [Branch,Request Model]
			*@return [view] <'branch.index'>
			*/
	public function index(Branch $branch , Request $request)
	{
		$branches = $branch
				->join('countries as country', 'country.id', '=', 'branches.country_id')
				->join('cities as city','city.id','=','branches.city_id')
				->join('teams as team','team.id','=','branches.team_id')
				->select(array(
								'branches.id as BranchID',
								'branches.name as name',
								'country.name as countryname',
								'branches.flag as flag',
								'team.name as teamname',
								'city.name as cityname',
								'branches.addition_info as addition_info',
							  ))
				->orderBy('country.name')->get();

		$tableData = Datatables::of($branches)
			 	->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"  width="50px" height="50px">')
				->addColumn('actions', function ($data)
					 				{
										return view('partials.actionBtns')->with('controller','branch')->with('id', $data->BranchID)->render();
									});

		if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
				$countries=Country::lists('name','id');
				$cities=City ::lists('name','id');
				$teams=Team ::lists('name','id');
		 	 	return view('branch.index')
			 	->with('countries',$countries)
			 	->with('cities',$cities)
			 	->with('teams',$teams)
			 	->with('tableData', DatatablePresenter::make($tableData, 'index'));
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
			*@var [obj] [$branch]
			*@uses [Request Model]
			* @return Response
			*/
	public function store(Request $request)
 	{
 		if(Input::hasFile('flag'))
		{
				$file = Input::file('flag');
			 	$filename=time();
			 	$file->move('images/uploads', $filename);
				$branch = new Branch;
 				$branch->name          		 =$request->name;
 				$branch->country_id    		 =$request->country_id;
				$branch->flag          		 =$filename;
				$branch->city_id       		 =$request->city_id;
				$branch->team_id             =$request->team_id;
				$branch->addition_info       =$request->addition_info;
 				$branch->save();
		if($request->ajax())
		{
				return response(array('msg' => 'Adding Successfull'), 200)
				->header('Content-Type', 'application/json');
		}
		}
		else
		{
				return response(false, 200)
				->header('Content-Type', 'application/json');
		}
 	}



	public function show($id)
	{
		//
	}

			/**
			**@method [return rows of city data] [selectCity]([[obj] [$request]])
			*[<to get all cities >]
			*@param [obj] [$request]
			*@var [int] [$country_id]
			*@var [obj] [$city]
			*@uses [Request,City Model]
			*@return rows of city data
			*/
	public function selectCity(Request $request)
	{
				$country_id = $request->country_id;
				echo $country_id;
				$city = City::where('country_id',$country_id)->get();
		  	echo'<option selected> اختار مدينه </option>';
		foreach($city as $row)
		{
				echo'<option value='.$row->id.'> '.$row->name.' </option>';
		}


	}
			/**
			*@method [return response] [edit]([[obj] [$request],[int][$id]])
			*[<show data to edit  >]
			*@param [int] [$id]
			*@param [obj] [$request]
			*@uses [Request Model]
			*@return response
			*/
	public function edit(Request $request , $id)
 	{
		 		$branch 	= Branch::find($id);
		 		session(['branchid'    => $branch->id]);
		 		session(['branchcity_id'    => $branch->city_id]);
				session(['branchimage' => $branch->flag]);

 		if($request->ajax()){
 				return response(array('msg' => 'Adding Successfull', 'data'=> $branch->toJson() ), 200)
 				->header('Content-Type', 'application/json');
 							}
 	}

			/**
			* Update the specified resource in storage.
			*@method [return response] [update]([[obj] [$request]])
			*[<to update data >]
			* @param  obj  $request
			* @return Response
			*/
	public function update(Request $request)
	{
				$branch = Branch::find(session('branchid'));
		if(!empty($_FILES))
		{
     	if(Input::hasFile('flag'))
		{
				$file = Input::file('flag');
				$filename=time();
				$file->move('images/uploads', $filename);
				if($request->city_id == 0)
				{
	  			$branch->city_id       =session('branchcity_id');
       			}
       	else
		{
       			$branch->city_id       		 =$request->city_id;
       	}
				$branch->name          		 =$request->name;
				$branch->country_id    		 =$request->country_id;
				$branch->flag          		 =$filename;
				$branch->team_id       		 =$request->team_id;
				$branch->addition_info       =$request->addition_info;
		}
		}
   		else
		{
   		if($request->city_id == 0)
		{
	  			$branch->city_id       =session('branchcity_id');
       	}
       	else
		{
       			$branch->city_id       		 =$request->city_id;
       	}
   				$branch->name          		 =$request->name;
				$branch->country_id    		 =$request->country_id;
				$branch->flag          		 =session('branchimage');
				$branch->team_id       		 =$request->team_id;
				$branch->addition_info       =$request->addition_info;
   		}
	 			$branch->save();
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
	 			$branch	= Branch::find($id);
	 			$branch->delete();
	 			if($request->ajax())
				{
	 					return response(array('msg' => 'Removing Successfull'), 200)
	 								->header('Content-Type', 'application/json');
	 			}
	 			return redirect()->back();
 	}
}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/