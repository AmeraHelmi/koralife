<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\Category;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class BlogController extends Controller {

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
			*@method [return view] [index]([[obj] [$blog],[obj] [$request]])
			*[<to get data from  DB  >]
			*@param [obj] [$blog]
			*@param [obj] [$request]
			*@uses [Blog,Request Model]
			*@return [view] <'blog.index'>
			*/
public function index(Blog $blog , Request $request)
{
	$blogs = $blog
		->select(array('id','title',
						'body','vedio_url',
						'flag','author',
						'date','likes'
				))
		->orderBy('id','desc')->get();
	$tableData = Datatables::of($blogs)
		->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"    					width="50px" height="50px">')
		->addColumn('actions', function ($data)
								{
								return view('partials.actionBtns')->with('controller','blog')->with('id', $data->id)->render();
								});
$categories=Category::lists('id','name');
	if($request->ajax())
		return DatatablePresenter::make($tableData, 'index');
		return view('blog.index')
		->with('categories',$categories)
		->with('tableData', DatatablePresenter::make($tableData, 'index'));
}


public function create()
{

}

			/**
			* Store a newly created resource in storage.
			**@method [return response] [store]([[obj] [$request]])
			*[<to store data >]
			*@param [obj] [$request]
			*@var [obj] [$blog]
			*@uses [Request Model]
			* @return Response
			*/
public function store(Request $request)
{
	if(Input::hasFile('flag'))
	{
		$file = Input::file('flag');
		$filename=time();
		$file->move('images/uploads', $filename);
		$blog = new Blog;
		$blog->title             =$request->title;
		$blog->flag              =$filename;
		$blog->body              =$request->body;
		$blog->vedio_url         =$request->vedio_url;
		$blog->author            =Auth::user()->name;
		$blog->date              =$request->date;
		$blog->cat_id            =$request->cat_id;
		$blog->save();

		 $tags=[];
		 $tags = explode("," , $request->tags);
		 foreach ($tags as $tag) {
				 $post_meta = new Tag();
					 $post_meta->page_id    =$blog->id;
					 $post_meta->meta_words =$tag;
					 $post_meta->url_word   ='blogs';
					 $post_meta->save();
		 }

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

}

			/**
			*@method [return response] [edit]([[int][$id]])
			*[<show data to edit  >]
			*@param [int] [$id]
			*@var [obj] [$blog]
			*@uses [Blog Model]
			*@return response
			*/
public function edit($id)
{
		$blog = Blog::find($id);
		session(['blogid'   => $blog->id]);
		session(['blogflag' => $blog->flag]);
		return response(array('msg' => 'Adding Successfull', 'data'=> $blog->toJson() ), 200)
								    ->header('Content-Type', 'application/json');
}

			/**
			* Update the specified resource in storage.
			**@method [return response] [update]([[obj] [$request])
			*[<to update data >]
			* @param  obj  $request
			* @return Response
			*/
public function update(Request $request)
{
 	$blog 	= Blog::find(session('blogid'));
	if(!empty($_FILES))
		{
			if(Input::hasFile('flag'))
			{
			$file = Input::file('flag');
			$filename=time();
			$file->move('images/uploads', $filename);
			$blog->title             =$request->title;
			$blog->flag              =$filename;
			$blog->body              =$request->body;
			$blog->vedio_url         =$request->vedio_url;
			$blog->date              =$request->date;
			$blog->cat_id            =$request->cat_id;
            }
        }
	else
	   {
			$blog->title             =$request->title;
			$blog->body              =$request->body;
			$blog->vedio_url         =$request->vedio_url;
			$blog->date              =$request->date;
		  $blog->flag              =session('blogflag');
			$blog->cat_id            =$request->cat_id;
	   }
			$blog->save();

			$tags=[];
			$tags = explode("," , $request->tags);
			if(count($request->tags)){
					$blog_metas = Tag::where('page_id',session('blogid'))->get();
					foreach($blog_metas as $blog_meta){
						$blog_meta->delete();
					}
			foreach ($tags as $tag) {
					$meta = new Tag();
						$meta->page_id    =session('blogid');
						$meta->meta_words =$tag;
						$meta->url_word   ='blogs';
						$meta->save();
					}
	}

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
			$blog = Blog::find($id);
			$blog->delete();
			if($request->ajax())
			{
				return response(array('msg' => 'Removing Successfull'), 200)
					->header('Content-Type', 'application/json');
			}
				return redirect()->back();
}
}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/
