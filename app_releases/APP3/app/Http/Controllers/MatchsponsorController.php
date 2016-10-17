<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Match;
use App\Models\sponsor;
use App\Models\Match_sponsor;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class MatchsponsorController extends Controller {


	public function __construct()
	{
	 	$this->middleware('auth');
 	}
	public function index(Match_sponsor $Msponsor , Request $request)
	{
		$Msponsor = $Msponsor
		  	->join('matches as M',  'M.id', '=',  'match_sponsors.match_id')
			->join('sponsors as S',  'S.id', '=',  'match_sponsors.sponsor_id')
			->join('teams as T1', 'T1.id', '=', 'M.team1_id')
		  	->join('teams as T2', 'T2.id', '=', 'M.team2_id')
			->select(array('match_sponsors.id as MSID', 'T1.name as T1name', 'T2.name as T2name','S.name as Sname','S.flag as Sflag'))
			->orderBY('MSID','desc')->get();

		$tableData = Datatables::of($Msponsor)
			->editColumn('Sflag', '<div class="image"><img src="images/uploads/{{ $Sflag }}"  width="50px" height="50px">')
		  	->editColumn('T1name', '{{ $T1name }} - {{ $T2name }}')
			->addColumn('actions', function ($data)
			{return view('partials.actionBtns')->with('controller','msponsors')->with('id', $data->MSID)->render(); });

		$match= new Match;
		$matches  = $match
			->join('teams as team1', 'team1.id', '=', 'matches.team1_id')
			->join('teams as team2', 'team2.id', '=', 'matches.team2_id')
			->select(array('team1.name as team1_name','team2.name as team2_name','matches.id as matchid'))
			->get();

			if($request->ajax())
			return DatatablePresenter::make($tableData, 'index');
				  $sponsors      = Sponsor::lists('name','id');
			return view('match_sponsors.index')
	  		->with('matches',$matches)
	  		->with('sponsors',$sponsors)
			->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}


	public function create()
	{
	}


	public function store(Request $request)
	{
		$count = count($request->sponsor_id);
		for($i = 0 ; $i < $count ; $i++)
		{
		$Msponsor = new Match_sponsor;
		$Msponsor->sponsor_id        =$request->sponsor_id[$i];
		$Msponsor->match_id          =$request->match_id;
		$Msponsor->save();
		}
		return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');

	}



	public function show()
	{
	}


	public function edit(Request $request , $id)
	{
		$Msponsor 	      = Match_sponsor::find($id);
		if($request->ajax())
		{
		return response(array('msg' => 'Adding Successfull', 'data'=> $Msponsor->toJson() ), 200)
		->header('Content-Type', 'application/json');
		}
	}


	public function update(Request $request , $id)
	{
		$count = count($request->sponsor_id);
		for($i = 0 ; $i < $count ; $i++)
		{
		$Msponsor = Match_sponsor::find($id);
		$Msponsor->sponsor_id        =$request->sponsor_id[$i];
		$Msponsor->match_id          =$request->match_id;
		$Msponsor->save();
		}
		if($request->ajax())
		{
		return response(array('msg' => 'Adding Successfull'), 200)
		->header('Content-Type', 'application/json');
		}
	}


	public function destroy($id)
	{
		$Msponsor 	= Match_sponsor::find($id);
		$Msponsor->delete();
		if($request->ajax())
		{
		return response(array('msg' => 'Removing Successfull'), 200)
		->header('Content-Type', 'application/json');
		}
		return redirect()->back();
	}

}
