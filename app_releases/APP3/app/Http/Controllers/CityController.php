<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;

class CityController extends Controller {

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
			*@method [return view] [index]([[obj] [$city],[obj] [$request]])
			*[<to get data of city>]
			*@param [obj] [$city]
			*@param [obj] [$request]
			*@uses [City,Request Model]
			*@return [view] <'city.index'>
			*/
	public function index(City $city , Request $request)
	{
		$cities = $city
				->join('countries as country', 'country.id', '=', 'cities.country_id')
				->select(array('cities.id as cityID',
						 		'cities.name as cityname',
								'country.name as countryname'))
				->orderBy('cities.id','desc')->get();

		$tableData = Datatables::of($cities)
				->addColumn('actions', function ($data)
				{
					return view('partials.actionBtns')->with('controller','city')->with('id', $data->cityID)
					->render();
				});

		if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
				$countries=Country::lists('name','id');
				return view('city.index')
		  		->with('countries',$countries)
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
			*@var [obj] [$city]
			*@uses [City,Request Model]
			*@return [Response]
			*/
	public function store(Request $request)
	{
		$city = new City;
		if($request->name)
		{
				$city->name          =$request->name;
				$city->country_id    =$request->country_id;
				$city->save();
				return response(array('msg' => 'Adding Successfull'), 200)
				->header('Content-Type', 'application/json');
		}
		else
		{
				return response(array('msg' => 'Adding Successfull'), 404)
				->header('Content-Type', 'application/json');
		}
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
			*@var [obj] [$city]
			*@uses [City,Request Model]
			*@return [response]
			*/
	public function edit(Request $request , $id)
	{
		$city 	= City::find($id);
		if($request->ajax())
		{
				return response(array('msg' => 'Adding Successfull', 'data'=> $city->toJson() ), 200)
				->header('Content-Type', 'application/json');
		}
	}

			/**
			 * Update the specified resource in storage.
			 **@method [return response] [update]([obj] [$request],[obj] [$id])
			 *[<to update data >]
			 * @param  obj  $request
			 * @param  obj  $id
			 * @return Response
			*/
	public function update(Request $request , $id)
 	{
		$city 	= City::find($id);
 		$city->name 	      = $request->name ;
 		$city->country_id 	  = $request->country_id ;
 		$city->save();
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
		$city 	= City::find($id);
		$city->delete();
		if($request->ajax())
		{
				return response(array('msg' => 'Removing Successfull'), 200)
				->header('Content-Type', 'application/json');
		}
				return redirect()->back();
	}
}
