<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Category;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class CategoryController extends Controller {

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
			*@method [return view] [index]([[obj] [$cat],[obj] [$request]]) 
			*[<to get data of categories [name]>]
			*@param [obj] [$cat] 
			*@param [obj] [$request] 
			*@uses [Category,Request Model] 
			*@return [view] <'category.index'>
			*/
	public function index(Category $cat , Request $request)
	{
        $categories = $cat
						->select(array('id', 'name'))
                        ->orderBy('id')->get();
        $tableData = Datatables::of($categories)
     	->addColumn('actions', function ($data)
								{
								  return view('partials.actionBtns')->with('controller','category')
								       ->with('id', $data->id)->render();
								});

        if($request->ajax())
				        return DatatablePresenter::make($tableData, 'index');
				        return view('category.index')
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
			*@var [obj] [$cat] [< data [name]>]
			*@uses [Category,Request Model]
			*@return [Response]
			*/
	public function store(Request $request)
	{
	    $cat = new Category;
        $cat->name    =$request->name;
        $cat->save();
        if($request->ajax())
        {
				       return response(array('msg' => 'adding Successfull'), 200)
                       ->header('Content-Type', 'application/json');
		}
	}


	
	public function show()
	{
		//
	}

			/**
			*@method [return response] [edit]([[obj] [$request],[int] [$id]]) 
			*[<to edit data >]
			*@param [obj] [$request] 
			*@param [int] [$id] 
			*@var [obj] [$cat]
			*@uses [Category,Request Model] 
			*@return [response]
			*/
	public function edit(Request $request , $id)
	{
    	$cat = Category::find($id);
		session(['catid'    => $cat->id]);
		if($request->ajax())
      {
                    return response(array('msg' => 'Adding Successfull', 'data'=> $cat->toJson() ), 200)
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
	public function update(Request $request )
	{

		$cat = Category::find(session('catid'));
		$cat->name 	= $request->name ;
		$cat->save();
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
		$cat 	= Category::find($id);
		$cat->delete();
		if($request->ajax())
		{
			return response(array('msg' => 'Removing Successfull'), 200)
								->header('Content-Type', 'application/json');
		}
		return redirect()->back();
	}

}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/