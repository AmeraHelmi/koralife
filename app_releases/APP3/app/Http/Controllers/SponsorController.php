<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Models\User;
use App\Models\Country;
use App\Models\Sponsor;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class SponsorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function __construct()
 {
	 $this->middleware('auth');
 }
	public function index(Sponsor $sponsor , Request $request)
	{
		$sponsors = $sponsor
			->select(array('id', 'name','flag','url'))
			->orderBY('id','desc')->get();

			$tableData = Datatables::of($sponsors)
			->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"  width="50px" height="50px">')
				->addColumn('actions', function ($data)
					{return view('partials.actionBtns')->with('controller','sponsor')->with('id', $data->id)->render(); });

			if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
		return view('sponsor.index')
			->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
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

			$sponsor = new Sponsor;
			    $sponsor->name    =$request->name;
				$sponsor->flag    =$filename;
				$sponsor->url     =$request->url;
			    $sponsor->save();

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
	public function show()
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request , $id)
	{
		$sponsor 	      = Sponsor::find($id);

				session(['sponserid'    => $sponsor->id]);
				session(['sponserimage' => $sponsor->flag]);

		if($request->ajax()){
			return response(array('msg' => 'Adding Successfull', 'data'=> $sponsor->toJson() ), 200)
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
		$sponsor 	= Sponsor::find(session('sponserid'));
		if(!empty($_FILES)){
			if(Input::hasFile('flag')){
		$file = Input::file('flag');
		$filename=time();
		$file->move('images/uploads', $filename);

			    $sponsor->name    =$request->name;
				$sponsor->flag    =$filename;
				$sponsor->url     =$request->url;
	}
}
    else{
			    $sponsor->name    =$request->name;
				$sponsor->url     =$request->url;
		    	$sponsor->flag     =session('sponserimage');
		}

		$sponsor->save();
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
		$sponsor 	= Sponsor::find($id);
		$sponsor->delete();
		if($request->ajax()){
			return response(array('msg' => 'Removing Successfull'), 200)
								->header('Content-Type', 'application/json');
			}
		return redirect()->back();
	}

}
