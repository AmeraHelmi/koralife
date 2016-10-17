<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Team;
use App\Models\Team_player;
use App\Models\Player;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;


class PlayerController extends Controller
{



	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Player $player , Request $request)
	{
		$players = $player
				->join('countries as country', 'country.id', '=', 'players.country_id')
				->join('teams as t', 't.id', '=', 'players.team_id')
				->select(array('players.id as playerID',
								'players.name as playername',
								't.name as team_name',
								'country.name as countryname',
								'players.weight as player_weight',
								'players.prefered_foot as player_prefered_foot',
								'players.speed as player_speed',
								'players.position as player_position',
								'players.flag as flag',
								'players.height as player_height',
								'players.addition_info as addition_info',
								'players.nationality as nationality'))
				->orderBy('players.id','desc')->get();

		$tableData = Datatables::of($players)
				->editColumn('flag', '<div class="image"><img src="images/uploads/{{ $flag }}"  width="50px" height="50px">')
				->addColumn('actions', function ($data)
					{
						return view('partials.actionBtns')->with('controller','player')->with('id', $data->playerID)->render(); });
		if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
				$countries=Country::lists('name','id');
				$cities=City ::lists('name','id');
				$teams=Team::where('is_team','like','منتخب%')->lists('name','id');
				return view('player.index')
				->with('countries',$countries)
				->with('cities',$cities)
				->with('teams',$teams)
				->with('tableData', DatatablePresenter::make($tableData, 'index'));
		}



	public function create()

	{
	}
	public function best_player(Request $request)
	{
		$player=new Player;
		$players = $player::where('best','like','YES')->get();
		foreach ($players as $obj)
		{
			# code...
			$obj->best="NO";
			$obj->save();
		}

		$player=Player::find($request->player_id);
		$player->best="YES";
		$player->save();
		return response(array('msg' => 'Adding Successfull'), 200)
							->header('Content-Type', 'application/json');
	}
	public function select_team(Request $request)
	{
	 	$team_type = $request->team_type;
	 	$teams = Team::where('is_team','like',$team_type)->get();
		echo'<option value="selected">النادى  </option>';
		foreach($teams as $row)
	 		{
	 			echo'<option value='.$row->id.'> '.$row->name.' </option>';
	 		}
	}
	public function select_player(Request $request)
	{
	 	$team_id = $request->team_id;
		$team_type = $request->team_type;
		$players = Team_player::where('team_id','=',$team_id)->get();

		// $player=new Player;
		// $players=$player->join('team_players as t','t.player_id','players.id')
		// 								->select(array('players.id ,players.name as name'))->where('t.team_id',$team_id)->get();
			foreach($players as $row)
			{
			 $playerss=Player::where('id','=',$row->player_id)->first();
				echo'<option value='.$row->player_id.'> '.$playerss->name.' </option>';
			// echo $row->player_id.'\n';
			}
	}

	public function store(Request $request)
	{
		if(Input::hasFile('flag'))
		{
			$file = Input::file('flag');
			$filename=time();
			$file->move('images/uploads', $filename);
			$player = new Player;
			$player->name          =$request->name;
			$player->nickname      =$request->nickname;
			$player->flag          =$filename;
			$player->city_id       =$request->city_id;
			$player->country_id    =$request->country_id;
			$player->prefered_foot =$request->prefered_foot;
			$player->weight        =$request->weight;
			$player->height        =$request->height;
			$player->speed         =$request->speed;
			$player->facebook      =$request->facebook;
			$player->twitter       =$request->twitter;
			$player->instagram     =$request->instagram;
			$player->num           =$request->num;
			$player->position      =$request->position;
			$player->birth_date    =$request->birth_date;
			$player->addition_info =$request->addition_info;
			$player->nationality   =$request->nationality;
			$player->team_id       =$request->team_id;
			$player->save();
			//  $maxplayer_id = Player::max('id');
			//  $newtid = new Team_player;
			//  $newtid->team_id   = $request->team_id;
			//  $newtid->player_id = $maxplayer_id;
			//  $newtid->save();
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



	//get all city

	public function selectCity(Request $request)
	{

		$country_id = $request->country_id;
		$city = City::where('country_id',$country_id)->get();
			echo'<option selected> اختار مدينه </option>';
		foreach($city as $row)
		{
			echo'<option value='.$row->id.'> '.$row->name.' </option>';
		}
	}



	public function edit(Request $request , $id)
	{

	 	$player 	= Player::find($id);
		session(['playerid'    => $player->id]);
	 	session(['playercity'    => $player->city_id]);
		session(['playerimage' => $player->flag]);
		if($request->ajax())
		{
			return response(array('msg' => 'Adding Successfull', 'data'=> $player->toJson() ), 200)
			->header('Content-Type', 'application/json');
		}
	}





	public function update(Request $request)
	{

		$player 	= Player::find(session('playerid'));
		$team_player = new Team_player;
		$tid= $team_player->where('player_id',session('playerid'))->first();
		$newtid = new Team_player;
		if(count($tid) > 0)
		{
			$tid->team_id    =$request->team_id;
	  		$tid->save();
		}
		else
		{
			$newtid->team_id=$request->team_id;
			$newtid->player_id=session('playerid');
			$newtid->save();
		}
		if(!empty($_FILES))
		{
		if(Input::hasFile('flag'))
		{
			$file = Input::file('flag');
			$filename=time();
			$file->move('images/uploads', $filename);
			if($request->city_id == 0)
			{
				$player->city_id       =session('playercity');

	       	}
			else
			{
				$player->city_id       =$request->city_id;
	    	}

	 		$player->name          =$request->name;
			$player->nickname      =$request->nickname;
			$player->flag          =$filename;
			$player->country_id    =$request->country_id;
			$player->prefered_foot =$request->prefered_foot;
			$player->weight        =$request->weight;
			$player->height        =$request->height;
			$player->speed         =$request->speed;
			$player->facebook      =$request->facebook;
			$player->twitter       =$request->twitter;
			$player->instagram     =$request->instagram;
			$player->num           =$request->num;
			$player->position      =$request->position;
			$player->birth_date    =$request->birth_date;
			$player->addition_info =$request->addition_info;
			$player->nationality   =$request->nationality;
			$player->team_id       =$request->team_id;
	    }
	   	}
	    else
		{
			if($request->city_id == 0)
			{
		  		$player->city_id       =session('playercity');
	       	}
	       	else
			{
	       		$player->city_id       =$request->city_id;
	       	}
	 		$player->name          =$request->name;
			$player->nickname      =$request->nickname;
			$player->flag          =session('playerimage');
			$player->country_id    =$request->country_id;
			$player->prefered_foot =$request->prefered_foot;
			$player->weight        =$request->weight;
			$player->height        =$request->height;
			$player->speed         =$request->speed;
			$player->facebook      =$request->facebook;
			$player->twitter       =$request->twitter;
			$player->instagram     =$request->instagram;
			$player->num           =$request->num;
			$player->position      =$request->position;
			$player->birth_date    =$request->birth_date;
			$player->addition_info =$request->addition_info;
			$player->nationality   =$request->nationality;
			$player->team_id       =$request->team_id;
		}
			$player->save();
			if($request->ajax())
			{
				return response(array('msg' => 'Adding Successfull'), 200)
				->header('Content-Type', 'application/json');
			}
	}





	public function destroy($id)
	{
		$player	= player::find($id);
		$player->delete();
		if($request->ajax())
		{
			return response(array('msg' => 'Removing Successfull'), 200)
			->header('Content-Type', 'application/json');
		}
			return redirect()->back();

	}

}
