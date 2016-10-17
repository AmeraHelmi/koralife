<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use App\Models\Category;
use App\Models\G_album_photo;
use App\Models\G_album;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class G_album_photoController extends Controller {

			/**
			 * Display a listing of the resource.
			 * @return Response
			 */
	public function __construct()
 	{
 		$this->middleware('auth');
 	}

			/**
			*@method [return view] [index]([[obj] [$g_photo],[obj] [$request]]) 
			*[<to get data of G_album_photo>]
			*@param [obj] [$g_photo] 
			*@param [obj] [$request] 
			*@uses [G_album_photo,Request Model] 
			*@return [view] <'g_album_photo.index'>
			*/
	public function index(G_album_photo $g_photo , Request $request)
	{
		$g_album_photos = $g_photo
						->join('g_albums as g','g.id','=','g_album_photos.g_album_id')
						->select(array('g_album_photos.id as GID',
										'g_album_photos.flag as flag',
										'g_album_photos.alt as alt',
										'g.title as title'))
						->orderBy('GID','desc')->get();

		$tableData = Datatables::of($g_album_photos)
						->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"  width="50px" height="50px">')
						->addColumn('actions', function ($data)
								{
						return view('partials.actionBtns')->with('controller','g_album_photo')->with('id', $data->GID)->render();
								});

		if($request->ajax())
		return DatatablePresenter::make($tableData, 'index');
		$albums=G_album::lists('id','title');
        $categories=Category::lists('id','name');
		return view('g_album_photo.index')
			    ->with('albums',$albums)
			    ->with('categories',$categories)
		      	->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}

	
	public function create()
	{
	}

	
		/**
			* Store a newly created resource in storage.
			*@method [return response] [store]([[obj] [$request]]) 
			*[<to insert data in DB>]
			*@param [obj] [$request] 
			*@var [obj] [$g_album] 
			*@uses [G_album_photo,Request Model]
			*@return [Response]
			*/
	public function store(Request $request)
	{

		$files = Input::file('flag');
		$file_count = count($files);
		$uploadcount = 0;
		$x = 0;
     	$allowedExts = array("jpeg", "jpg", "png", "gif");
		foreach($files as $file)
		{
			$x++;
			$g_album = new G_album_photo;
			$filename=time() + $x;
			$ext=pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION);
		if(in_array($ext,$allowedExts))
      	{
        	$file->move('images/uploads', $filename);
		    $g_album->alt           =$filename;
			$g_album->flag          =$filename;
			$g_album->g_album_id    =$request->g_album_id;
			$g_album->save();
		    $uploadcount ++;
      	}
		
		}
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




	public function show()
	{
	}


/**
			*@method [return response] [edit]([[obj] [$request],[int] [$id]],[obj] [$g_album]) 
			*[<to edit data >]
			*@param [obj] [$request] 
			*@param [int] [$id] 
			*@var [obj] [$g_album]
			*@uses [G_album_photo,Request Model] 
			*@return [response]
			*/
	public function edit(G_album_photo $g_album , Request $request , $id)
	{
		$g_album  = $g_album->find($id);
		session(['albumid'   => $g_album->id]);
		session(['albumflag' => $g_album->flag]);
		return response(array('msg' => 'Adding Successfull', 'data'=> $g_album->toJson() ), 200)
		->header('Content-Type', 'application/json');

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
 		$g_album 	= G_album_photo::find(session('albumid'));
		if(!empty($_FILES))
		{
			if(Input::hasFile('flag'))
			{
			 	$file 					= Input::file('flag');
			 	$filename				=time();
			 	$file->move('images/uploads', $filename);
			 	$g_album->g_album_id    =$request->g_album_id;
			 	$g_album->alt    		=$request->alt;
			 	$g_album->flag    		=$filename;
    		}
   		}
		else
		{
			$g_album->g_album_id    =$request->g_album_id;
			$g_album->alt    		=$request->alt;
			$g_album->flag    		=session('albumflag');
		}
			$g_album->save();
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
		$g_album 	= G_album_photo::find($id);
		$g_album->delete();
		if($request->ajax()){
		return response(array('msg' => 'Removing Successfull'), 200)
		->header('Content-Type', 'application/json');
			}
		return redirect()->back();
	}

}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/