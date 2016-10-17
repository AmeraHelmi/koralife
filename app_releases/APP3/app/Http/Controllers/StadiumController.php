<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Championship_sponsor;
use App\Models\Shoe;
use App\Models\Player;
use App\Models\Stadium;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;


class StadiumController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 	 public function __construct()
 	{
 		$this->middleware('auth');
 	}
	 public function index(Stadium $stadium , Request $request)
	 {
		 $stadia = $stadium
			 ->join('countries as country', 'country.id', '=', 'stadia.country_id')
			 ->join('cities as city','city.id','=','stadia.city_id')
			 ->select(array(
				 'stadia.id as stadiaID',
			   'stadia.name as name',
				 'country.name as countryname',
				 'stadia.capacity as capacity',
				 'stadia.flag as stadium_image',
				 'stadia.ground as ground',
			   'city.name as cityname',

		 ))
		 ->orderBy('country.name')->get();

			 $tableData = Datatables::of($stadia)
			  ->editColumn('stadium_image', '<div class="image"><img src="images/uploads/{{ $stadium_image }}"  width="50px" height="50px">')
				 ->addColumn('actions', function ($data)
					 {return view('partials.actionBtns')->with('controller','stadium')->with('id', $data->stadiaID)->render(); })
				 ;

			 if($request->ajax())
				 return DatatablePresenter::make($tableData, 'index');
				 $countries=Country::lists('name','id');
				 $cities=City ::lists('name','id');

		 return view('stadium.index')
			 ->with('countries',$countries)->with('cities',$cities)
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
	 *
	 * @return Response
	 */
	 public function store(Request $request)
 	{


		if(Input::hasFile('flag')){
			 $file = Input::file('flag');
			 $filename=time();
			 $file->move('images/uploads', $filename);

 		$stadium = new Stadium;
 			$stadium->name          =$request->name;
 			$stadium->country_id    =$request->country_id;
			$stadium->capacity      =$request->capacity;
			$stadium->city_id       =$request->city_id;
			$stadium->ground        =$request->ground;
			$stadium->flag          =$filename;
			$stadium->addition_info    =$request->addition_info;

 			$stadium->save();

			if($request->ajax()){
				return response(array('msg' => 'Removing Successfull'), 200)
									->header('Content-Type', 'application/json');
				}
			return redirect()->back();
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

//get all city
	public function selectCity(Request $request)
	{
		$country_id = $request->country_id;
		echo $country_id;
		$city = City::where('country_id',$country_id)->get();
			echo'<option selected> اختار مدينه</option>';
		foreach($city as $row){
			echo'<option value='.$row->id.'> '.$row->name.' </option>';
		}


	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 public function edit(Request $request , $id)
 	{
 		$stadium 	= Stadium::find($id);
		session(['stadiumid'   => $stadium->id]);
		session(['stadiumcity_id'   => $stadium->city_id]);
		session(['stadiumflag' => $stadium->flag]);

 		if($request->ajax()){
 			return response(array('msg' => 'Adding Successfull', 'data'=> $stadium->toJson() ), 200)
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
		$stadium 	= Stadium::find(session('stadiumid'));

		if(!empty($_FILES)){
			if(Input::hasFile('flag')){
		$file = Input::file('flag');
		$filename=time();
		$file->move('images/uploads', $filename);

	if($request->city_id == 0){
	  $stadium->city_id       =session('stadiumcity_id');
       	}
       	else{
       $stadium->city_id       =$request->city_id;
       	}
		$stadium->name          =$request->name;
		$stadium->country_id    =$request->country_id;
		$stadium->capacity      =$request->capacity;
		$stadium->ground         =$request->ground;
		$stadium->flag        =$filename;
		$stadium->addition_info    =$request->addition_info;
	}
}
else{
		if($request->city_id == 0){
	  $stadium->city_id       =session('stadiumcity_id');
       	}
       	else{
       $stadium->city_id       =$request->city_id;
       	}
	$stadium->name          =$request->name;
	$stadium->country_id    =$request->country_id;
	$stadium->capacity      =$request->capacity;
	$stadium->ground         =$request->ground;
	$stadium->addition_info    =$request->addition_info;
	$stadium->flag        =session('stadiumflag');
}
		$stadium->save();

		if($request->ajax()){
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
 		$stadium	= Stadium::find($id);
 		$stadium->delete();
 		if($request->ajax()){
 			return response(array('msg' => 'Removing Successfull'), 200)
 								->header('Content-Type', 'application/json');
 			}
 		return redirect()->back();
 	}


}
