<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Teamcloth;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class TeamclothController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function __construct()
 {
	 $this->middleware('auth');
 }
	 public function index(Teamcloth $teamcloth , Request $request)
	{
	 $teamcloths = $teamcloth
		 ->join('teams as team', 'team.id', '=', 'teamcloths.team_id')
		 ->select(array(
			 'teamcloths.id as teamclothID',
			 'team.id as team_id',
			 'team.name as teamname',
			 'teamcloths.principle_cloths as principle_cloths',
		   'teamcloths.reserve_cloths as reserve_cloths',
		   'teamcloths.reserve2_cloths as reserve2_cloths',
		   'teamcloths.practise_cloths as practise_cloths'))
		->orderBy('teamclothID')->get();

		 $tableData = Datatables::of($teamcloths)
		 ->editColumn('principle_cloths','<div class="image"><img src="images/uploads/{{ $principle_cloths }}"   width="50px" height="50px">')
		 ->editColumn('reserve_cloths',  '<div class="image"><img src="images/uploads/{{ $reserve_cloths   }}"   width="50px" height="50px">')
		 ->editColumn('reserve2_cloths', '<div class="image"><img src="images/uploads/{{ $reserve2_cloths  }}"   width="50px" height="50px">')
		 ->editColumn('practise_cloths', '<div class="image"><img src="images/uploads/{{ $practise_cloths  }}"   width="50px" height="50px">')

		 ->addColumn('actions', function ($data)
				 {return view('partials.actionBtns')->with('controller','teamcloth')->with('id', $data->teamclothID)->render(); })
			 ;

		 if($request->ajax())
			 return DatatablePresenter::make($tableData, 'index');

			 $teams=Team::lists('name','id');

	 return view('teamcloth.index')
	   ->with('teams',$teams)
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
		 if(
		  Input::hasFile('principal') && Input::hasFile('reserve')
		    &&
				Input::hasFile('practise') || Input::hasFile('reserve2')){

				$file = Input::file('principal');
				$filename=time();
				$file->move('images/uploads', $filename);

				$file = Input::file('reserve');
				$filename2=time() + 2;
				$file->move('images/uploads', $filename2);

				$file = Input::file('practise');
				$filename4=time() + 3;
				$file->move('images/uploads', $filename4);

      if(Input::hasFile('reserve2')){
				$file = Input::file('reserve2');
				$filename3=time() + 4;
				$file->move('images/uploads', $filename3);

			}

	 	$teamcloth = new Teamcloth;
	 	$teamcloth->team_id             =$request->team_id;
	 	$teamcloth->principle_cloths    =$filename;
		$teamcloth->reserve_cloths      =$filename2;
		$teamcloth->practise_cloths     =$filename4;
		  if(Input::hasFile('reserve2')){
				$teamcloth->reserve2_cloths     =$filename3;
			}

	 	$teamcloth->save();

		if($request->ajax()){
			return response(array('msg' => 'Adding Successfull'), 200)
								->header('Content-Type', 'application/json');
			}
		}
		else{
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

 public function select_team(Request $request)
	{

			$team_type = $request->team_type;
			$teams = Team::where('is_team','like',$team_type)->get();
			 foreach($teams as $row)
			 {
				 echo'<option value='.$row->id.'> '.$row->name.' </option>';
			 }
	}
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
	 public function edit(Request $request , $id)
	{
		$teamcloth= Teamcloth::find($id);

		session(['teamclothid'      => $teamcloth->id]);
		session(['principalimage'   => $teamcloth->principle_cloths]);
		session(['reserveimage'     => $teamcloth->reserve_cloths]);
		session(['reserve2image'    => $teamcloth->reserve2_cloths]);
		session(['practiseimage'    => $teamcloth->practise_cloths]);

		if($request->ajax()){
			return response(array('msg' => 'Adding Successfull', 'data'=> $teamcloth->toJson() ), 200)
								->header('Content-Type', 'application/json');
			}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 public function update(Request $request)
	 {
	 $teamcloth= Teamcloth::find(session('teamclothid'));
	 if(!empty($_FILES)){
		 	 $teamcloth->team_id   =$request->team_id;

		 if(Input::hasFile('principal')){

			$file = Input::file('principal');
			$filename=time();
			$file->move('images/uploads', $filename);

			$teamcloth->principle_cloths =$filename;
		}
		else{
			$teamcloth->principle_cloths =session('principalimage');
		}

	/*//////////////////*/
		if(Input::hasFile('reserve')){
			$file = Input::file('reserve');
			$filename2=$file->getClientOriginalName();
			$file->move('images/uploads', $filename2);

			$teamcloth->reserve_cloths   =$filename2;
		}
		else{
			$teamcloth->reserve_cloths   =session('reserveimage');
		}

	/*//////////////////*/
		if(Input::hasFile('practise')){
			$file = Input::file('practise');
			$filename4=$file->getClientOriginalName();
			$file->move('images/uploads', $filename4);

			$teamcloth->practise_cloths =$filename4;
		}
		else{
		 $teamcloth->practise_cloths  =session('practiseimage');
		}

	/*//////////////////*/
		if(Input::hasFile('reserve2')){
			$file = Input::file('reserve2');
			$filename3=$file->getClientOriginalName();
			$file->move('images/uploads', $filename3);

			$teamcloth->reserve2_cloths =$filename3;
		}
		else{
		 $teamcloth->reserve2_cloths  =session('reserve2image');
		}

	}
	 else{
		 $teamcloth->team_id             =$request->team_id;
		 $teamcloth->principle_cloths    =session('principalimage');
		 $teamcloth->reserve_cloths      =session('reserveimage');
		 $teamcloth->practise_cloths     =session('practiseimage');
		 $teamcloth->reserve2_cloths     =session('reserve2image');

	 }

	 $teamcloth->save();

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
	 $teamcloth= Teamcloth::find($id);
 	 $teamcloth->delete();
 	 if($request->ajax()){
 		 return response(array('msg' => 'Removing Successfull'), 200)
 							 ->header('Content-Type', 'application/json');
 		 }
 	 return redirect()->back();
  }

}
