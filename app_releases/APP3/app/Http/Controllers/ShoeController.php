<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Ball;
use App\Models\Shoe;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class ShoeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function __construct()
 {
	 $this->middleware('auth');
 }
	 public function index(Shoe $shoe , Request $request)
 	{
 		$shoes = $shoe
 			->select(array('id','brand','flag'))
			->orderBy('id','desc')->get();

			$tableData = Datatables::of($shoes )
		  	->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"  width="50px" height="50px">')
				->addColumn('actions', function ($data)
					{return view('partials.actionBtns')->with('controller','shoe')->with('id', $data->id)->render(); })
				;

			if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');

		return view('shoe.index')
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

		$shoe = new Shoe;
			$shoe->brand          =$request->brand;
			$shoe->flag           =$filename;

			$shoe->save();

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
	 public function edit(Request $request , $id)
	{
		$shoe 	= Shoe::find($id);

		session(['shoesid'    => $shoe->id]);
		session(['shoesimage' => $shoe->flag]);

		if($request->ajax()){
			return response(array('msg' => 'Adding Successfull', 'data'=> $shoe->toJson() ), 200)
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
		$shoe 	= Shoe::find(session('shoesid'));
		if(!empty($_FILES)){
			if(Input::hasFile('flag')){
		$file = Input::file('flag');
		$filename=time();
		$file->move('images/uploads', $filename);

 		$shoe->brand 	      = $request->brand ;
 		$shoe->flag       	= $filename ;
  }
}
   else{
		 $shoe->brand 	      = $request->brand ;
		 $shoe->flag        	= session('shoesimage') ;
	 }
 		$shoe->save();

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
 	$shoe 	= Shoe::find($id);
 	$shoe->delete();
 	if($request->ajax()){
 		return response(array('msg' => 'Removing Successfull'), 200)
 							->header('Content-Type', 'application/json');
 		}
 	return redirect()->back();
 }
}
