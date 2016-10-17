<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Member;
use App\Models\Pcomment;
use App\Models\Bcomment;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;

class MemberController extends Controller {

	public function __construct()
	{
 		$this->middleware('auth');
 	}

	public function index(Member $member , Request $request)
	{
		$members = $member
		->select(array('id','username','email','image'))
		->orderBy('id','desc')->get();

		$tableData = Datatables::of($members)
		  ->editColumn('image', '<div class="image"><img src="images/uploads/{{ $image }}"  width="50px" height="50px">')
			->addColumn('actions', function ($data)
							{
								return view('members/partials.actionBtns')->with('controller','members')->with('member_id', $data->id)->render();
							});
		if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
				return view('members.index')
				->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}


	public function create()
	{
		//
	}


	public function store(Request $request)
	{
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
		$member= Member::find($id);
		$bcomments= Bcomment::where('person_id',$id)->get();
 		$pcomments= Pcomment::where('person_id',$id)->get();
		foreach($bcomments as $bcomment){
			$bcomment->delete();
		}
		foreach($pcomments as $pcomment){
			$pcomment->delete();
		}
 		$member->delete();
 		if($request->ajax())
			{
 				return response(array('msg' => 'Removing Successfull'), 200)
 					->header('Content-Type', 'application/json');
 			}
 		return redirect()->back();
 	}
}
/**@copyright 2016 The PHP Group [Amera Helmi ,Alaa Ragab,Lamess Said]*/
