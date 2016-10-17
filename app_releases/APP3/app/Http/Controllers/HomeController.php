<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Team;
use App\Models\Match;
use App\Models\Coach;
use App\Models\Player_match;
use App\Models\Reserve_player;
use App\Models\Snew;
use App\Models\Sponsor;
use App\Models\Championship;
use App\Models\Referee;
use App\Models\Championship_sponsor;
use App\Models\Stadium;
use App\Models\Country;
use App\Models\Team_player;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Carbon\Carbon;
class HomeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct()
	{
		$this->middleware('auth');
    }
	public function index()
	{
		$Allmatch= new Match;
		$Allmatch = $Allmatch
			->join('teams as T1', 'T1.id', '=', 'matches.team1_id')
			->join('teams as T2', 'T2.id', '=', 'matches.team2_id')
			->select(array('T1.name as T1name','T2.name as T2name'
							,'matches.id as match_id',
							'matches.team1_goals as team1_goals',
							'matches.team2_goals as team2_goals',
							'matches.match_date as match_date',
							'T1.flag as T1flag',
							'T2.flag as T2flag',
							'T1.id as T1ID',
							'T2.id as T2ID'
				 		))
			->where('date',date('Y-m-d'))->orderBy('match_id','desc')->get();
			return view('home')
			->with('Allmatch',$Allmatch);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
