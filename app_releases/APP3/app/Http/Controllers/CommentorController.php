<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Commentor;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;


class CommentorController extends Controller {


	public function __construct()
	{
		$this->middleware('auth');
	}

			/**
			*@method [return view] [index]([[obj] [$commentor],[obj] [$request]])
			*[<to get data of commentor>]
			*@param [obj] [$commentor]
			*@param [obj] [$request]
			*@uses [Commentor,Request Model]
			*@return [view] <'commentor.index'>
			*/
	public function index(Commentor $commentor , Request $request)
	{
		$commentors = $commentor
				    ->join('countries as country', 'country.id', '=', 'commentors.country_id')
					->join('cities as city','city.id','=','commentors.city_id')
					->select(array('commentors.id as commentorID',
								    'commentors.name as name',
									'country.name as countryname',
									'commentors.flag as flag',
									'commentors.nationality as nationality',
								    'city.name as cityname'
							 	))
					->orderBy('country.name')->get();

		$tableData = Datatables::of($commentors)
			        ->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"  width="50px" height="50px">')
				    ->addColumn('actions', function ($data)
					    {
							return view('partials.actionBtns')->with('controller','commentor')->with('id', $data->commentorID)->render();
						});

		if($request->ajax())
				   return DatatablePresenter::make($tableData, 'index');
				   $countries=Country::lists('name','id');
				   $cities=City ::lists('name','id');
		           return view('commentor.index')
			       ->with('countries',$countries)->with('cities',$cities)
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
			*@var [obj] [$commentor]
			*@uses [Commentor,Request Model]
			*@return [Response]
			*/
	 public function store(Request $request)
 	{
		if(Input::hasFile('flag'))
		{
			$file = Input::file('flag');
			$filename=time();
			$file->move('images/uploads', $filename);
      		$commentor = new Commentor;
 			$commentor->name          	=$request->name;
 			$commentor->country_id    	=$request->country_id;
			$commentor->city_id       	=$request->city_id;
			$commentor->nationality   	=$request->nationality;
			$commentor->birth_date   	=$request->birth_date;
			$commentor->addition_info	=$request->addition_info;
			$commentor->flag          	=$filename;
			$commentor->save();
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
			*@var [obj] [$commentor]
			*@uses [Commentor,Request Model]
			*@return [response]
			*/
	public function edit(Request $request , $id)
 	{
 		$commentor 	= Commentor::find($id);
		session(['commentorid'    => $commentor->id]);
		session(['commentorcity_id'    => $commentor->city_id]);
		session(['commentorimage' => $commentor->flag]);
 		if($request->ajax())
		{
 			return response(array('msg' => 'Adding Successfull', 'data'=> $commentor->toJson() ), 200)
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
		$commentor 	= Commentor::find(session('commentorid'));
		if(!empty($_FILES))
		{
			if(Input::hasFile('flag'))
			{
				$file = Input::file('flag');
				$filename=time();
				$file->move('images/uploads', $filename);
	 			if($request->city_id == 0)
				{
	  				$commentor->city_id       =session('commentorcity_id');
       	}
       	else
				{
       				$commentor->city_id        =$request->city_id;
       			}
					$commentor->name            =$request->name;
					$commentor->country_id      =$request->country_id;
					$commentor->nationality     =$request->nationality;
					$commentor->birth_date   	=$request->birth_date;
					$commentor->addition_info	=$request->addition_info;
					$commentor->flag            =$filename;
			}
		}
    	else
		{
  		if($request->city_id == 0)
			{
	  	 			$commentor->city_id       =session('commentorcity_id');
       		}
       else
			{
       				$commentor->city_id       =$request->city_id;
       		}
					$commentor->name            =$request->name;
					$commentor->country_id      =$request->country_id;
					$commentor->nationality     =$request->nationality;
					$commentor->birth_date   	=$request->birth_date;
					$commentor->addition_info	=$request->addition_info;
					$commentor->flag            =session('commentorimage');
		}
					$commentor->save();
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
 		$commentor	= Commentor::find($id);
 		$commentor->delete();
 		if($request->ajax()){
		 			return response(array('msg' => 'Removing Successfull'), 200)
		 			->header('Content-Type', 'application/json');
 			}
 					return redirect()->back();
 	}


}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/