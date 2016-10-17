<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ball;
use App\Models\Group;
use App\Models\Team;
use App\Models\Managment_championship;
use App\Models\Player;
use App\Models\Manager;
use App\Models\Sponsor;
use App\Models\Player_sponsor;
use App\Models\Team_history_coach;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;


class Player_sponsorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
 	{
	 	$this->middleware('auth');
 	}
	public function index(Player_sponsor $p_sponsor , Request $request)
	{
		$player_sponsors = $p_sponsor
			->join('players as player','player.id','=','player_sponsors.player_id')
			->join('sponsors as sponsor','sponsor.id','=','player_sponsors.sponsor_id')

			->select(array('player_sponsors.id as p_sponsorID',
			   				'player.name as player_name',
				 			'sponsor.name as sponsor_name',
				 			'player_sponsors.from_date as from_date',
				 			'player_sponsors.to_date as to_date',
				 			'player_sponsors.amount as amount'
			 			))

			->orderBy('player_sponsors.id','desc')->get();

		$tableData = Datatables::of($player_sponsors)

			->addColumn('actions', function ($data)
			{return view('partials.actionBtns')->with('controller','player_sponsor')->with('id', $data->p_sponsorID)->render(); });
		if($request->ajax())
			return DatatablePresenter::make($tableData, 'index');
		//  $championships=Championship::lists('name','id');

		$players= Player::lists('name','id');
		$sponsors =Sponsor::lists('name','id');
			return view('player_sponsor.index')
			->with('players',$players)
			->with('sponsors',$sponsors)
			->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}



	public function create()
	{
		//
	}

	
	public function store(Request $request)
 	{
		$p_sponsor = new Player_sponsor;
		$p_sponsor->player_id          =$request->player_id;
		$p_sponsor->sponsor_id         =$request->sponsor_id;
		$p_sponsor->from_date          =$request->from_date;
		$p_sponsor->to_date            =$request->to_date;
		$p_sponsor->amount             =$request->amount;
		$p_sponsor->addition_info      =$request->addition_info;
		$p_sponsor->save();
		if($request->ajax()){
			return response(array('msg' => 'Adding Successfull'), 200)
			->header('Content-Type', 'application/json');
				}
	}



	
	public function show($id)
	{
		//
	}

	public function edit(Request $request , $id)
 	{
 		$p_sponsor 	= Player_sponsor::find($id);
 		if($request->ajax()){
 		return response(array('msg' => 'Adding Successfull', 'data'=> $p_sponsor->toJson() ), 200)
 		->header('Content-Type', 'application/json');
 			}
 	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 public function update(Request $request,$id)
	{
		$p_sponsor 	= Player_sponsor::find($id);
		$p_sponsor->player_id          =$request->player_id;
		$p_sponsor->sponsor_id         =$request->sponsor_id;
		$p_sponsor->from_date          =$request->from_date;
		$p_sponsor->to_date        	   =$request->to_date;
		$p_sponsor->amount             =$request->amount;
		$p_sponsor->addition_info      =$request->addition_info;
		$p_sponsor->save();
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
 		$p_sponsor	= Player_sponsor::find($id);
 		$p_sponsor->delete();
 		if($request->ajax()){
 			return response(array('msg' => 'Removing Successfull'), 200)
 			->header('Content-Type', 'application/json');
 			}
 		return redirect()->back();
 	}


}
