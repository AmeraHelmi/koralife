<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Models\G_album;
use App\Models\Category;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class G_albumController extends Controller {

			/**
			 * Display a listing of the resource.
			 * @return Response
			 */
	public function __construct()
	{
        $this->middleware('auth');
	}
			/**
			*@method [return view] [index]([[obj] [$album],[obj] [$request]]) 
			*[<to get data of G_album>]
			*@param [obj] [$album] 
			*@param [obj] [$request] 
			*@uses [G_album,Request Model] 
			*@return [view] <'g_album.index'>
			*/
	public function index(G_album $album , Request $request)
	{
      	$g_albums = $album
            	->join('categories as c ','c.id','=','g_albums.category_id')
				->select(array('g_albums.id as G_id',
								'g_albums.title as G_title',
								'c.name as C_name'))
                ->orderBy('G_title')->get();

      	$tableData = Datatables::of($g_albums)
                ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','g_album')->with('id', $data->G_id)->render();

            });
        $categories=Category::lists('id','name');

        if($request->ajax())
		return DatatablePresenter::make($tableData, 'index');
		return view('g_album.index')
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
			*@uses [G_album,Request Model]
			*@return [Response]
			*/
	public function store(Request $request)
	{

        $g_album = new G_album;
        $g_album->title          =$request->title;
        $g_album->category_id    =$request->category_id;
        $g_album->save();
        if($request->ajax())
            {
                return response(array('msg' => 'adding Successfull'), 200)
                ->header('Content-Type', 'application/json');
			}

	}


	
	public function show()
	{
	}

			/**
			*@method [return response] [edit]([[obj] [$request],[int] [$id]]) 
			*[<to edit data >]
			*@param [obj] [$request] 
			*@param [int] [$id] 
			*@var [obj] [$g_album]
			*@uses [G_album,Request Model] 
			*@return [response]
			*/
	public function edit(Request $request , $id)
	{
            $g_album = G_album::find($id);
            if($request->ajax())
                {
                    return response(array('msg' => 'Adding Successfull', 'data'=> $g_album->toJson() ), 200)
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

		$g_album = G_album::find($id);
		$g_album->title 	     = $request->title ;
        $g_album->category_id    =$request->category_id;


		$g_album->save();
		return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');
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
		$g_album 	= G_album::find($id);
		$g_album->delete();
		if($request->ajax()){
			return response(array('msg' => 'Removing Successfull'), 200)
			->header('Content-Type', 'application/json');
				}
		return redirect()->back();
	}

}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/