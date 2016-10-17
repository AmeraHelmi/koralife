<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\V_album;
use App\Models\Country;
use App\Models\Team;
use App\Models\Tag;
use App\Models\Nation;
use App\Models\Category;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class V_albumController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	 {
      $this->middleware('auth');
	 }
	public function index(V_album $album , Request $request)
	{
            $v_albums = $album
		    ->join('categories as c ','c.id','=','v_albums.category_id')
			->select(array(
				    'v_albums.id as VID',
						'v_albums.title as title',
						'v_albums.vedio_url as vedio_url',
						'v_albums.description as description',
						'v_albums.flag as flag',
						'v_albums.view_count as view_count',
						'v_albums.like_count as like_count',
						'c.name as cname'))
            ->orderBy('title')->get();

            $tableData = Datatables::of($v_albums)
						->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"  width="50px" height="50px">')
             ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','v_album')->with('id', $data->VID)->render();
            });

            if($request->ajax())
		return DatatablePresenter::make($tableData, 'index');
		$categories=Category::lists('id','name');
		return view('v_album.index')
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

         $v_album = new V_album;
         $v_album->title        =$request->title;
				 $v_album->vedio_url    =$request->vedio_url."?autoplay=1";
				 $v_album->category_id  =$request->category_id;
				 $v_album->flag         =$filename;
				 $v_album->description  =$request->description;
				 $v_album->save();
				 $v_album->date  =date('Y-m-d');
				 $v_album->save();

				 $tags=[];
				 $tags = explode("," , $request->tags);
				 foreach ($tags as $tag) {
						 $video_meta = new Tag();
							 $video_meta->page_id    =$v_album->id;
							 $video_meta->meta_words =$tag;
							 $video_meta->url_word   ='videos';
							 $video_meta->save();
				 }
			}
			if($request->ajax())
		 {
				 return response(array('msg' => 'adding Successfull'), 200)
												 ->header('Content-Type', 'application/json');
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request , $id)
	{
			$v_album = V_album::find($id);
			session(['Vid'    => $v_album->id]);
			session(['Vimage' => $v_album->flag]);
      if($request->ajax())
      {
					return response(array('msg' => 'Adding Successfull', 'data'=> $v_album->toJson() ), 200)
                            ->header('Content-Type', 'application/json');
			}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request )
	{
		$v_album 	= V_album::find(session('Vid'));

		if(!empty($_FILES))
		{
			if(Input::hasFile('flag'))
			{
				$file = Input::file('flag');
				$filename=time();
				$file->move('images/uploads', $filename);

				$v_album->flag    =$filename;
				$v_album->title 	= $request->title ;
				$v_album->vedio_url 	= $request->vedio_url ;
				$v_album->category_id    =$request->category_id;
				$v_album->description    =$request->description;
			}
		}
		else
		{
				$v_album->flag=session('Vimage');
				$v_album->title 	= $request->title ;
				$v_album->vedio_url 	= $request->vedio_url ;
				$v_album->category_id    =$request->category_id;
				$v_album->description    =$request->description;
		}
		$v_album->save();

		$tags=[];
		$tags = explode("," , $request->tags);
		if(count($request->tags)){
				$video_metas = Tag::where('page_id',session('Vid'))->get();
				foreach($video_metas as $video_meta){
					$video_meta->delete();
				}
		foreach ($tags as $tag) {
				$video_meta = new Tag();
					$video_meta->page_id      =session('Vid');
					$video_meta->meta_words =$tag;
					$video_meta->url_word   ='videos';
					$video_meta->save();
				}
}
		return response(array('msg' => 'Adding Successfull'), 200)
							->header('Content-Type', 'application/json');

}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$v_album 	= V_album::find($id);
		$v_album->delete();
		if($request->ajax())
		{
			  return response(array('msg' => 'Removing Successfull'), 200)
								->header('Content-Type', 'application/json');
		}
		return redirect()->back();
	}

}
