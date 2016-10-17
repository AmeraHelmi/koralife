<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\City;
use App\Models\Championship_sponsor;
use App\Models\Coach;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;


class CoachController extends Controller {


	public function __construct()
 	{
 		$this->middleware('auth');
 	}
	public function best_coach(Request $request)
	{
		$coach=new Coach;
		$coachs = $coach::where('best','like','YES')->get();
		foreach ($coachs as $obj)
		{
			# code...
			$obj->best="NO";
			$obj->save();
		}

		$coach=Coach::find($request->coach_id);
		$coach->best="YES";
		$coach->save();
		return response(array('msg' => 'Adding Successfull'), 200)
							->header('Content-Type', 'application/json');
	}

			/**
			*@method [return view] [index]([[obj] [$coach],[obj] [$request]])
			*[<to get data of Coach>]
			*@param [obj] [$coach]
			*@param [obj] [$request]
			*@uses [Coach,Request Model]
			*@return [view] <'coach.index'>
			*/
	public function index(Coach $coach , Request $request)
	{
		$coaches = $coach
			 	->join('countries as country', 'country.id', '=', 'coaches.country_id')
			 	->join('cities as city','city.id','=','coaches.city_id')
			 	->select(array('coaches.id as coachID',
			     				'coaches.name as name',
				 				'country.name as countryname',
				 				'coaches.nickname as nickname',
				 				'coaches.flag as flag',
								'city.name as cityname'
		 						))
		 		->orderBy('coachID','desc')->get();

		$tableData = Datatables::of($coaches)
				->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"  width="50px" height="50px">')
				->addColumn('actions', function ($data)
					{
						return view('partials.actionBtns')->with('controller','coach')->with('id', $data->coachID)->render();
					});

		if($request->ajax())
						return DatatablePresenter::make($tableData, 'index');
				 		$countries=Country::lists('name','id');
						$cities=City ::lists('name','id');
				 		$coachs=Coach ::lists('name','id');
		 	 	 		return view('coach.index')
			 			->with('countries',$countries)->with('cities',$cities)->with('coachs',$coachs)
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
			*@var [obj] [$coach]
			*@uses [Coach,Request Model]
			*@return [Response]
			*/

	public function store(Request $request)
 	{
 		if(Input::hasFile('flag'))
			{
			 	$file = Input::file('flag');
			 	$filename=time();
			 	$file->move('images/uploads', $filename);
 				$coach = new Coach;
 				$coach->name          =$request->name;
 				$coach->country_id    =$request->country_id;
				$coach->nickname      =$request->nickname;
				$coach->city_id       =$request->city_id;
				$coach->flag          =$filename;
				$coach->role          =$request->role;
				$coach->birth_date    =$request->birth_date;
				$coach->additional_info    =$request->additional_info;
				$coach->save();
			if($request->ajax()){
				return response(array('msg' => 'Adding Successfull'), 200)
				->header('Content-Type', 'application/json');
				}
			}
		else{
				return response(false, 200)
				->header('Content-Type', 'application/json');
			}
 	}



	public function show($id)
	{
		//
	}

//get all city *@method [] [selectCity]([obj] [$request])
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
			*@method [return response] [edit]([[obj] [$request],[int] [$id]])
			*[<to edit data >]
			*@param [obj] [$request]
			*@param [int] [$id]
			*@var [obj] [$coach]
			*@uses [Coach,Request Model]
			*@return [response]
			*/
	public function edit(Request $request , $id)
 	{
 		$coach 	= Coach::find($id);
		session(['coachid'    => $coach->id]);
		session(['coachcity_id'    => $coach->city_id]);
		session(['coachimage' => $coach->flag]);
 		if($request->ajax())
			{
	 			return response(array('msg' => 'Adding Successfull', 'data'=> $coach->toJson() ), 200)
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
		$coach 	= Coach::find(session('coachid'));

		if(!empty($_FILES))
		{
     	if(Input::hasFile('flag'))
			{
				$file = Input::file('flag');
				$filename=time();
				$file->move('images/uploads', $filename);
       	if($request->city_id == 0)
			{
	  			$coach->city_id =session('coachcity_id');
       	  	}
       	else
			{
            	$coach->city_id       =$request->city_id;
       	  	}
				$coach->name          =$request->name;
				$coach->country_id    =$request->country_id;
				$coach->nickname      =$request->nickname;
				$coach->flag          =$filename;
				$coach->role          =$request->role;
				$coach->birth_date    =$request->birth_date;
				$coach->additional_info          =$request->additional_info;
		 	}
		}
	  	else
			{
       	if($request->city_id == 0)
			{
	  			$coach->city_id  =session('coachcity_id');
       		}
       	else
			{
          		$coach->city_id       =$request->city_id;
       		}
	   			$coach->name          =$request->name;
				$coach->country_id    =$request->country_id;
				$coach->nickname      =$request->nickname;
				$coach->flag          =session('coachimage');
				$coach->role          =$request->role;
				$coach->birth_date    =$request->birth_date;
				$coach->additional_info          =$request->additional_info;
	   	}
		 		$coach->save();
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
 		$coach	= Coach::find($id);
 		$coach->delete();
 		if($request->ajax())
 			{
	 			return response(array('msg' => 'Removing Successfull'), 200)
	 			->header('Content-Type', 'application/json');
 			}
 				return redirect()->back();
 	}
}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/
