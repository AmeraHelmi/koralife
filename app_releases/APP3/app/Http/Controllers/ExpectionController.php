<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Input;
use Auth;
use App\Models\Expection;
use App\Models\Championship;

class ExpectionController extends Controller {

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
			*@method [return view] [index]([[obj] [$expection],[obj] [$request]])
			*[<to get data of expection>]
			*@param [obj] [$expection]
			*@param [obj] [$request]
			*@uses [Expection,Request Model]
			*@return [view] <'expection.index'>
			*/
	public function index(Expection $expection , Request $request)
	{
		$expections = $expection
			->orderBy('id')->get();

		$tableData = Datatables::of($expections)
			->addColumn('actions', function ($data)
			{return view('partials.actionBtns')->with('controller','expection')->with('id', $data->id)->render(); })
				 ;

		if($request->ajax())
			return DatatablePresenter::make($tableData, 'index');
			$championships=Championship::lists('name','id');
		 	return view('expection.index')
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
			*@var [obj] [$expection]
			*@uses [Expection,Request Model]
			*@return [Response]
			*/

	 public function store(Request $request)
 	{

 		$expection                   = new Expection;
		$expection->question_text    =$request->question_text;
		$expection->ans1             =$request->ans1;
		$expection->ans2             =$request->ans2;
		$expection->ans3             =$request->ans3;
		$expection->ans4             =$request->ans4;
		$expection->date             =date("Y/m/d");
 		$expection->save();
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
			*@var [obj] [$expection]
			*@uses [Expection,Request Model]
			*@return [response]
			*/
	 public function edit(Request $request , $id)
 	{
 		$expection= Expection::find($id);
 		if($request->ajax()){
 			return response(array('msg' => 'Adding Successfull', 'data'=> $expection->toJson() ), 200)
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
	   	$expection= Expection::find($id);
			$expection->question_text    =$request->question_text;
			$expection->ans1             =$request->ans1;
			$expection->ans2             =$request->ans2;
			$expection->ans3             =$request->ans3;
			$expection->ans4             =$request->ans4;

			$expection->save();
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
 		$expection= Expection::find($id);
 		$expection->delete();
 		if($request->ajax()){
 			return response(array('msg' => 'Removing Successfull'), 200)
 			->header('Content-Type', 'application/json');
 			}
 		return redirect()->back();
 	}

}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/
