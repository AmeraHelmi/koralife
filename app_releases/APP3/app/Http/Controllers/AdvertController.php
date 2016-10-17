<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use App\Models\Advert;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;
class AdvertController extends Controller {

	/**
	 * Display a listing of the resource.
	 *@method [] [construct]([[] [no parameter]<, ...>])
* [<it checks into auth if the user is login or not >]

	 * @return Response
	 */
	public function __construct()
 	{
 		$this->middleware('auth');
 	}
 	/**
 	*@method [return view 'advert.index'] [index]([[obj] [$advert],[obj] [$request]])
 	* [<to return datatable of user data >]
 	*@var [obj] [$adverts] [<take array of 'latest' or new data [id,name,flag]>]
 	*@return [return view 'advert.index]
 	*/
	public function index(Advert $advert , Request $request)
	{
		$adverts = $advert
			->select(array('id', 'name', 'flag','url','page_name','place','height','width'))
			->orderBy('id','desc')->get();

		$tableData = Datatables::of($adverts)
	  	->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"  width="50px" height="50px">')
			->editColumn('height', '{{ $height }}*{{ $width }}')
			->addColumn('actions', function ($data)
					{
						return view('partials.actionBtns')->with('controller','advert')->with('id', $data->id)->render();
				  });

			if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
		return view('advert.index')
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
	 * Store a newly created resource in DB.
	 * @method [responce msg] [store]([[obj] [$request]])
	 *[<Store a newly created advertisment  in DB>]
	 *@var [obj] [$advert] [<insert array of new data [name,flag]>]
	 * @return Response msg of status 200
	 */
	public function store(Request $request)
	{
		 if(Input::hasFile('flag'))
		 {
		    $file = Input::file('flag');
			  $filename=time();
		    $file->move('images/uploads', $filename);
				$advert = new Advert;
				if($request->name)
				{
					$advert->name    =$request->name;
					$advert->url    =$request->url;
			  	$advert->flag    =$filename;
					$advert->page_name    =$request->page_name;
					$advert->place    =$request->place;
					$advert->height    =$request->height;
					$advert->width    =$request->width;
			  	$advert->save();
					if($request->ajax())
					{
						return response(array('msg' => 'Adding Successfull'), 200)
										->header('Content-Type', 'application/json');
					}
				}
    }
		else
		{
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
	 * @method [Response] [edit]([[obj] [$advert],[obj] [$request],[int] [$id])
	 *[<edit data of advertisment>]
	 * @param  int  $id
	 * @param  obj $advert
	  * @param  obj $request
	 * @return Response
	 */
	public function edit(Advert $advert , Request $request , $id)
	{
		$advert       = $advert->find($id);
		session(['advertid'   => $advert->id]);
		session(['advertflag' => $advert->flag]);
		return response(array('msg' => 'Adding Successfull', 'data'=> $advert->toJson() ), 200)
								->header('Content-Type', 'application/json');
	}

	/**
	 * Update the specified resource in storage.
	 * @method [Response] [update]([[obj] [$request],[int] [$id]]) [<Update advertisment data [flag,name]>]
	 * @param  obj  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
      $advert 	= Advert::find(session('advertid'));
			if(!empty($_FILES))
			{
				if(Input::hasFile('flag'))
				{
			 		$file = Input::file('flag');
			 		$filename=time();
			 		$file->move('images/uploads', $filename);
			 		$advert->name    =$request->name;
					$advert->url    =$request->url;
			 		$advert->flag    =$filename;
					$advert->page_name    =$request->page_name;
					$advert->place    =$request->place;
					$advert->height    =$request->height;
					$advert->width    =$request->width;
       	}
   		}
			else
			{
					$advert->name    =$request->name;
					$advert->url    =$request->url;
					$advert->flag    =session('advertflag');
					$advert->page_name    =$request->page_name;
					$advert->place    =$request->place;
					$advert->height    =$request->height;
					$advert->width    =$request->width;
			}
			$advert->save();
	 		if($request->ajax())
			{
	 					return response(array('msg' => 'Adding Successfull'), 200)
	 								->header('Content-Type', 'application/json');
	 		}
	}

	/**
	 * Remove 'Delete' the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response msg of status 200
	 */
	public function destroy($id)
	{
		$advert 	= Advert::find($id);
		$advert->delete();
		if($request->ajax())
		{
			return response(array('msg' => 'Removing Successfull'), 200)
								->header('Content-Type', 'application/json');
			}
		return redirect()->back();
	}
}
/**@copyright 2016 The PHP Team [Amera Helmi,Alaa Ragab, Lamess Said]*/
