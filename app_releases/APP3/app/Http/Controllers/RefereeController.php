<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\Championship_sponsor;
use App\Models\City;
use App\Models\Player;
use App\Models\Referee;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;


class RefereeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
 	{
 		$this->middleware('auth');
 	}
	public function index(Referee $referee , Request $request)
	{
		$referees = $referee
			->join('countries AS country', 'country.id', '=', 'referees.country_id')
			->join('cities as city','city.id','=','referees.city_id')
			->select(array('referees.id as refereeID',
			    			'referees.name as refereename',
				 			'country.name as countryname',
				 		  	'referees.job as referee_job',
				 		  	'referees.birth_date as referees_birth_date',
			     			'city.name as cityname',
			     			'referees.flag as referee_image'
		 				))
		 	->orderBy('country.name')->get();

		$tableData = Datatables::of($referees)
			->editColumn('referee_image', '<div class="image"><img src="images/uploads/{{ $referee_image }}"  width="50px" height="50px">')
			->addColumn('actions', function ($data)
				{return view('partials.actionBtns')->with('controller','referee')->with('id', $data->refereeID)->render(); });

		if($request->ajax())
			return DatatablePresenter::make($tableData, 'index');
			$countries=Country::lists('name','id');
			$cities=City ::lists('name','id');
			$referees=Referee ::lists('name','id');
		 	return view('referee.index')
			->with('countries',$countries)->with('cities',$cities)->with('referees',$referees)
			->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}




	public function best_referee(Request $request)
	{
		$referee=new Referee;
		$referees = $referee::where('best','like','YES')->get();
		foreach ($referees as $obj)
		{
			# code...
			$obj->best="NO";
			$obj->save();
		}

		$referee=Referee::find($request->referee_id);
		$referee->best="YES";
		$referee->save();
		return response(array('msg' => 'Adding Successfull'), 200)
							->header('Content-Type', 'application/json');
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
		if(Input::hasFile('flag'))
		{
			$file = Input::file('flag');
			$filename=time();
			$file->move('images/uploads', $filename);

			$referee = new Referee;
			$referee->name          =$request->name;
			$referee->country_id    =$request->country_id;
			$referee->job           =$request->job;
			$referee->role           =$request->role;
			$referee->birth_date           =$request->birth_date;
			$referee->city_id       =$request->city_id;
			$referee->additional_info          =$request->additional_info;
			$referee->flag          =$filename;
			$referee->save();
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





	 //get all city
	 	public function selectCity(Request $request)
	 	{
	 		$country_id = $request->country_id;
	 		echo $country_id;
	 		$city = City::where('country_id',$country_id)->get();
				echo'<option selected> اختار مدينه </option>';
	 		foreach($city as $row){
	 			echo'<option value='.$row->id.'> '.$row->name.' </option>';
	 			}
    	}
	public function edit(Request $request , $id)
 	 	{
 	 		$referee 	= Referee::find($id);
			session(['refereeid'   => $referee->id]);
			session(['refereecity_id'   => $referee->city_id]);
	 		session(['refereeflag' => $referee->flag]);
 	 		if($request->ajax()){
 	 			return response(array('msg' => 'Adding Successfull', 'data'=> $referee->toJson() ), 200)
 	 			->header('Content-Type', 'application/json');
 	 			}
 	 	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$referee 	= Referee::find(session('refereeid'));
		if(!empty($_FILES))
		{
		if(Input::hasFile('flag'))
		{
			$file = Input::file('flag');
			$filename=time();
			$file->move('images/uploads', $filename);
   		if($request->city_id == 0)
   		{
	  		$referee->city_id    =session('refereecity_id');
       	}
       	else
       	{
       		$referee->city_id         =$request->city_id;
       	}
			$referee->name           =$request->name;
			$referee->country_id     =$request->country_id;
			$referee->job            =$request->job;
			$referee->birth_date     =$request->birth_date;
			$referee->role           =$request->role;
			$referee->flag           =$filename;
			$referee->additional_info          =$request->additional_info;

   		}
		}
		else
		{
		if($request->city_id == 0)
		{
	  		$referee->city_id       =session('refereecity_id');
       	}
       	else
       	{
       		$referee->city_id       =$request->city_id;
       	}
			$referee->name          		=$request->name;
			$referee->country_id    		=$request->country_id;
			$referee->job           		=$request->job;
			$referee->role           =$request->role;
			$referee->birth_date           =$request->birth_date;
	    	$referee->additional_info       =$request->additional_info;
			$referee->flag           		=session('refereeflag');
		}
		$referee->save();
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
	  	$referee	= Referee::find($id);
	  	$referee->delete();
	  	if($request->ajax()){
	 	 	return response(array('msg' => 'Removing Successfull'), 200)
	 		->header('Content-Type', 'application/json');
	 	}
	  	return redirect()->back();
	}

}
