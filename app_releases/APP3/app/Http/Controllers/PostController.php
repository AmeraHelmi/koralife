<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class PostController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    public function __construct()
	{
 		$this->middleware('auth');
 	}
	public function index(Post $post , Request $request)
	{
		$posts = $post
			->select(array('id', 'title','body','flag','author','date','likes'))
			->orderBy('id','desc')->get();
		$tableData = Datatables::of($posts)
			->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"  width="50px" height="50px">')
			->addColumn('actions', function ($data)
			{return view('partials.actionBtns')->with('controller','post')->with('id', $data->id)->render(); });
$categories=Category::lists('id','name');
		if($request->ajax())
			return DatatablePresenter::make($tableData, 'index');
			return view('post.index')
			->with('categories',$categories)
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
		if(Input::hasFile('flag'))
		{
			$file = Input::file('flag');
			$filename=time();
			$file->move('images/uploads', $filename);
			$post = new Post;
			$post->title             =$request->title;
			$post->flag              =$filename;
			$post->alt              =$request->alt;
			$post->body              =$request->body;
			$post->author            =Auth::user()->name;
			$post->date              =$request->date;
			$post->cat_id              =$request->cat_id;
			$post->save();

			$tags=[];
			$tags = explode("," , $request->tags);
			foreach ($tags as $tag) {
					$post_meta = new Tag();
						$post_meta->page_id    =$post->id;
						$post_meta->meta_words =$tag;
						$post_meta->url_word   ='posts';
						$post_meta->save();
			}

		if($request->ajax()){
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
	public function edit($id)
	{
		$post       = Post::find($id);

		session(['postid'   => $post->id]);
		session(['postflag' => $post->flag]);
		return response(array('msg' => 'Adding Successfull', 'data'=> $post->toJson() ), 200)
		->header('Content-Type', 'application/json');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$post 	= Post::find(session('postid'));
		if(!empty($_FILES)){
		if(Input::hasFile('flag'))
		{
			$file = Input::file('flag');
			$filename=time();
			$file->move('images/uploads', $filename);
			$post->title             =$request->title;
			$post->flag              =$filename;
		    $post->alt              =$request->alt;
			$post->body              =$request->body;
			$post->date              =$request->date;
			$post->cat_id              =$request->cat_id;
       	}
   		}
		else
		{
			$post->title             =$request->title;
			$post->body              =$request->body;
			$post->date              =$request->date;
			$post->alt              =$request->alt;
			$post->cat_id              =$request->cat_id;
		    $post->flag              =session('postflag');
		}
			$post->save();

			$tags=[];
			$tags = explode("," , $request->tags);
			if(count($request->tags)){
					$post_metas = Tag::where('page_id',session('postid'))->get();
					foreach($post_metas as $post_meta){
						$post_meta->delete();
					}
			foreach ($tags as $tag) {
					$meta = new Tag();
						$meta->page_id    =session('postid');
						$meta->meta_words =$tag;
						$meta->url_word   ='posts';
						$meta->save();
					}
   }
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
		$post 	= Post::find($id);
		$post->delete();
		if($request->ajax()){
			return response(array('msg' => 'Removing Successfull'), 200)
			->header('Content-Type', 'application/json');
			}
		return redirect()->back();
	}

}
