<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use App\Models\Snew;
use App\Models\Cnew;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Championship_sponsor;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class SnewController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
public function __construct()
{
		// $this->middleware('auth');

}

public function index(Snew $snew , Request $request)
{
		$snews = $snew
		            ->join('categories as cat','cat.id','=','snews.cat_id')
								->select(array('snews.id as id', 'snews.title as title',
								               'snews.flag as flag','snews.date as date','snews.publish as publish','cat.name as cat_name'))
								->orderBy('id','desc')->get();

		$tableData = Datatables::of($snews)
								->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"  width="50px" height="50px">')
								->addColumn('actions', function ($data)
								{
									return view('snew/partials.actionBtns')
									->with('controller','snew')
									->with(['id'=> $data->id,'publish'=>$data->publish])
									->render();
								});
		$categories=Category::lists('id','name');
				if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
	  return view('snew.index')
		        ->with('categories',$categories)
			      ->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */


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

			  $snew = new Snew;
			  $snew->title              =$request->title;
			  $snew->flag               =$filename;
				$snew->date               =$request->date;
				$snew->cat_id             =$request->cat_id;
				$snew->user_id            =Auth::user()->id;
				$snew->additional_info    =$request->additional_info;
				$snew->save();

				$tags=[];
				$tags = explode("," , $request->tags);
				foreach ($tags as $tag) {
						$new_meta = new Tag();
					    $new_meta->page_id    =$snew->id;
							$new_meta->meta_words =$tag;
							$new_meta->url_word   ='news';
							$new_meta->save();
				}

				if($request->ajax()){
					return response(array('msg' => 'Adding Successfull'), 200)
										->header('Content-Type', 'application/json');
					}
				else{
					return response(false, 200)
										->header('Content-Type', 'application/json');
				}

    }
	}

	public function getnews(Request $request)
	{
			$category_id = $request->category_id;
			$news = Snew::where('cat_id',$category_id)->where('date',date('Y-m-d'))->get();
				echo'<option selected> اختار خبر </option>';
			foreach($news as $row)
			{
				echo'<option value='.$row->id.'> '.$row->title.' </option>';
			}
	}

		public function update_today_new(Request $request)
		{
			$category_id = $request->cat_id;
			$new_id      = $request->id;

			$news = Snew::where('cat_id',$category_id)->where('id',$new_id)->first();
			$news->today_new = 'YES';
			$news->save();

			return response(array('msg' => 'Adding Successfull'), 200)
							->header('Content-Type', 'application/json');
		}

		public function edit_today_new(Request $request)
		{
			//delete old_today_new
			$category_id = $request->cat_id;
			$news = Snew::where('cat_id',$category_id)->where('today_new','YES')->where('date',date('Y-m-d'))->first();
		  $news->today_new = 'NO';
			$news->save();
			//add today_new New
			$category_id = $request->cat_id;
			$new_id      = $request->id;

			$new = Snew::where('cat_id',$category_id)->where('id',$new_id)->first();
			$new->today_new = 'YES';
			$new->save();

			return response(array('msg' => 'Adding Successfull'), 200)
							->header('Content-Type', 'application/json');
		}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Snew $snew , Request $request , $id)
	{

		$snew       = Snew::find($id);

		session(['snewid'   => $snew->id]);
		session(['snewflag' => $snew->flag]);

			return response(array('msg' => 'Adding Successfull', 'data'=> $snew->toJson() ), 200)
								->header('Content-Type', 'application/json');

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	 public function publish(Request $request ,$id)
	 {
		  $snew 	= Snew::find($id);
			$snew->publish ='YES';
			$snew->save();
			return response(array('msg' => 'Adding Successfull'), 200)
							->header('Content-Type', 'application/json');
	 }

	 public function nopublish(Request $request ,$id)
	 {
			$snew 	= Snew::find($id);
			$snew->publish ='NO';
			$snew->save();
			return response(array('msg' => 'Adding Successfull'), 200)
							->header('Content-Type', 'application/json');
	 }

	public function update(Request $request)
	{
 $snew 	= Snew::find(session('snewid'));

	if(!empty($_FILES)){
		if(Input::hasFile('flag')){
			 $file = Input::file('flag');
			 $filename=time();
			 $file->move('images/uploads', $filename);

		 $snew->title              =$request->title;
		 $snew->flag               =$filename;
		 $snew->date               =$request->date;
		 $snew->user_id            =Auth::user()->id;
		 $snew->cat_id             =$request->cat_id;
		 $snew->additional_info    =$request->additional_info;
       	}
   }
	else{
		$snew->title              =$request->title;
		$snew->date               =$request->date;
		$snew->user_id            =Auth::user()->id;
		$snew->cat_id             =$request->cat_id;
		$snew->additional_info    =$request->additional_info;
		$snew->flag               =session('snewflag');
	}
	$snew->save();

	$tags=[];
	$tags = explode("," , $request->tags);
	if(count($request->tags)){
			$new_metas = Tag::where('page_id',session('snewid'))->get();
			foreach($new_metas as $new_meta){
				$new_meta->delete();
			}
	foreach ($tags as $tag) {
			$new_meta = new Tag();
				$new_meta->page_id    =session('snewid');
				$new_meta->meta_words =$tag;
				$new_meta->url_word   ='news';
				$new_meta->save();
			}
}
	else{}

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
		$snew 	= Snew::find($id);

		$metas= Tag::where('page_id',$id)->get();
		foreach($metas as $meta){
			$meta->delete();
		}

		$snew->delete();
		if($request->ajax()){
			return response(array('msg' => 'Removing Successfull'), 200)
								->header('Content-Type', 'application/json');
			}
		return redirect()->back();
	}

}
