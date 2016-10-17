<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ball;
use App\Models\Championship;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;
class BallController extends Controller {
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
			*@method [return view] [index]([[obj] [$ball],[obj] [$request]])
			*[<to get data from 3 tables [matches,teams] in DB to get[Author,analysis_id,analysis_date,T1name,T2name] >]
			*@param [obj] [$ball]
			*@param [obj] [$request]
			*@uses [Ball,Request Model]
			*@return [view] <'ball.index'>
			*/
	public function index(Ball $ball , Request $request)
	{
		 $balls = $ball
			 					->select(array('id','brand','flag'))
			 					->orderBy('id','desc')->get();
		 $tableData = Datatables::of($balls)
			 	 				->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"  width="50px" height="50px">')
				 				->addColumn('actions', function ($data)
					 			{
									return view('partials.actionBtns')->with('controller','ball')->with('id', $data->id)->render();
								});
		if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
		 		return view('ball.index')
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
			*@var [obj] [$ball]
			*@uses [Request Model]
			* @return Response
			*/
	public function store(Request $request)
 	{
 		if(Input::hasFile('flag'))
		    {
			    $file = Input::file('flag');
			    $filename=$file->getClientOriginalName();
			    $file->move('images/uploads', $filename);
 					$ball = new Ball;
					$ball->brand           =$request->brand;
 					$ball->addition_info   =$request->addition_info;
					$ball->flag            =$filename;
 					$ball->save();
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
			*@method [return response] [edit]([[obj] [$request],[int][$id]])
			*[<show data to edit  >]
			*@param [int] [$id]
			*@param [obj] [$request]
			*@var [obj] [$ball]
			*@uses [Request Model]
			*@return response
			*/
	public function edit(Request $request , $id)
 	{
 			$ball 	= Ball::find($id);
 			session(['ballid'    => $ball->id]);
			session(['ballimage' => $ball->flag]);
 			if($request->ajax())
			{
 				return response(array('msg' => 'Adding Successfull', 'data'=> $ball->toJson() ), 200)
 						->header('Content-Type', 'application/json');
 			}
 	}
	/**
			 * Update the specified resource in storage.
			 **@method [return response] [update]([[obj] [$request]])
			*[<to update data >]
			 * @param  obj  $request
			 *@uses Ball Model
			 * @return Response
			 */
	public function update(Request $request)
	{
			$ball 	= Ball::find(session('ballid'));
			if(!empty($_FILES))
			{
     		if(Input::hasFile('flag'))
				{
						$file = Input::file('flag');
						$filename=$file->getClientOriginalName();
						$file->move('images/uploads', $filename);
						$ball->brand           =$request->brand;
						$ball->addition_info   =$request->addition_info;
						$ball->flag         =$filename;
				}
            }
   		    else
			{
			    	$ball->brand           =$request->brand;
				    $ball->addition_info   =$request->addition_info;
						$ball->flag              =session('ballimage');
   		}
			$ball->save();
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
 			$ball	= Ball::find($id);
 			$ball->delete();
 			if($request->ajax())
			{
 				return response(array('msg' => 'Removing Successfull'), 200)
 						->header('Content-Type', 'application/json');
 			}
 		return redirect()->back();
 	}
}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/
