<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Ball;
use App\Models\Player;
use App\Models\Championship;
use App\Models\Championship_sponsor;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class ChampionshipController extends Controller
{

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
			*@method [return view] [index]([[obj] [$championship],[obj] [$request]])
			*[<to get data of championship [name,no_matches,addition_info,type]>]
			*@param [obj] [$championship]
			*@param [obj] [$request]
			*@uses [Championship,Request Model]
			*@return [view] <'championship.index'>
			*/
	public function index(Championship $championship , Request $request)
	{
		 	$championships = $championship
			 				->join('countries as country', 'country.id', '=', 'championships.country_id')
							->join('Balls as B','B.id','=','championships.ball_id')
							->select(array('championships.id as championshipID',
			   								'championships.name as name',
				 							'country.name as countryname',
				 							'championships.no_matches as no_matches',
				 							'championships.addition_info as addition_info',
											'championships.type as type',
				 							'B.brand as B_brand'
				 		 					))
		 					->orderBy('championshipID')->get();

			$tableData = Datatables::of($championships)
				 			->addColumn('actions', function ($data)
					 						{
											return view('partials.actionBtns')->with('controller','championship')->with('id', $data->championshipID)->render();
											});

			if($request->ajax())
							return DatatablePresenter::make($tableData, 'index');
							$countries=Country::lists('name','id');
							$balls=Ball::lists('brand','id');
							return view('championship.index')
							->with('balls',$balls)
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
			*@var [obj] [$championship]
			*@uses [Championship,Request Model]
			*@return [Response]
			*/
	public function store(Request $request)
 	{
 		$championship = new Championship;
 		$championship->name          =$request->name;
 		$championship->country_id    =$request->country_id;
		$championship->no_matches    =$request->no_matches;
		$championship->type          =$request->type;
		$championship->addition_info =$request->addition_info;
		$championship->year          =$request->year;
		$championship->ball_id       =$request->ball_id;
		$championship->continent     =$request->continent;
 		$championship->save();
		if($request->ajax())
		{
							return response(array('msg' => 'Adding Successfull'), 200)
							->header('Content-Type', 'application/json');
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
			*@method [return response] [edit]([[obj] [$request],[int] [$id]])
			*[<to edit data >]
			*@param [obj] [$request]
			*@param [int] [$id]
			*@var [obj] [$championship]
			*@uses [Championship,Request Model]
			*@return [response]
			*/
	public function edit(Request $request , $id)
 	{
 		$championship = Championship::find($id);
		session(['championid' => $championship->id]);
 		if($request->ajax())
		{
 							return response(array('msg' => 'Adding Successfull', 'data'=> $championship->toJson() ), 200)
 							->header('Content-Type', 'application/json');
 		}
 	}

			/**
			 * Update the specified resource in storage.
			 **@method [return response] [update]([obj] [$request])
			 *[<to update data >]
			 * @param  obj  $request
			 * @return Response
			*/
	public function update(Request $request)
	{
		$championship 	= Championship::find(session('championid'));
		$championship->name          =$request->name;
		$championship->country_id    =$request->country_id;
		$championship->no_matches    =$request->no_matches;
		$championship->type          =$request->type;
		$championship->addition_info =$request->addition_info;
	  $championship->year          =$request->year;
		$championship->ball_id       =$request->ball_id;
		$championship->continent     =$request->continent;
		$championship->save();
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
 		$championship= Championship::find($id);
 		$championship->delete();
 		if($request->ajax())
		{
 							return response(array('msg' => 'Removing Successfull'), 200)
 							->header('Content-Type', 'application/json');
 		}
 							return redirect()->back();
 	}
}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/
