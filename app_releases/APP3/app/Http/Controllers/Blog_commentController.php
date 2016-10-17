<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Bcomment;
use App\Models\User;
use App\Models\Blog;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class Blog_commentController extends Controller {

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
			*@method [return view] [index]([[obj] [$bcomment],[obj] [$request]])
			*[<to get data from 2 tables [users,blogs] in DB to get[user_name,blog_id] >]
			*@param [obj] [$bcomment]
			*@param [obj] [$request]
			*@uses [Bcomment,Request Model]
			*@return [view] <'blog_comments.index'>
			*/
	public function index(Bcomment $bcomment , Request $request)
	{
		$bcomments = $bcomment
		->join('blogs as b','b.id','=','bcomments.blog_id')
		->select(array('bcomments.id as bcomments_id',
						'b.title as blog_title',
						'bcomments.comment as comment',
						'bcomments.role as role',
						'bcomments.date as date'))
		->orderBy('bcomments_id','desc')->get();

		$tableData = Datatables::of($bcomments)
			->addColumn('actions', function ($data)
							{
								return view('blog_comments/partials.actionBtns')->with('controller','blog-comments')->with('Bcomments_id', $data->bcomments_id)->render();
							});
  $blogs = Blog::lists('title','id');
		if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
				return view('blog_comments.index')
				->with('blogs',$blogs)
				->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}


	public function create()
	{
		//
	}


	public function store(Request $request)
	{
		$bcomment = new Bcomment();
				$bcomment->blog_id       =$request->blog_id;
				$bcomment->comment       =$request->comment;
				$bcomment->date          =$request->date;
				$bcomment->person_id     =Auth::user()->id;
				$bcomment->role          ='Admin';
				$bcomment->save();
				return response(array('msg' => 'Adding Successfull'), 200)
				->header('Content-Type', 'application/json');
	}


	public function show($id)
	{
		//
	}


	public function edit($id)
	{
		//
	}


	public function update($id)
	{
		//
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
 		$bcomment= Bcomment::find($id);
 		$bcomment->delete();
 		if($request->ajax())
			{
 				return response(array('msg' => 'Removing Successfull'), 200)
 					->header('Content-Type', 'application/json');
 			}
 		return redirect()->back();
 	}
}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/
