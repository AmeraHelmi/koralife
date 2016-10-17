<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Nation;
use App\Models\Nationcloth;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Input;

class NationclothController extends Controller 
{

	
	public function __construct()
 	{
	 	$this->middleware('auth');
 	}
	public function index(Nationcloth $nationcloth , Request $request)
	{
	 	$nationcloths = $nationcloth
		->join('nations as nation', 'nation.id', '=', 'nationcloths.nation_id')
		->select(array('nationcloths.id as nationclothID',
					    'nation.id as nation_id',
						'nation.nickname as nationname',
						'nationcloths.principle_cloths as principle_cloths',
					    'nationcloths.reserve_cloths as reserve_cloths',
					    'nationcloths.reserve2_cloths as reserve2_cloths',
					    'nationcloths.practise_cloths as practise_cloths'
					))
		->orderBy('nationclothID')->get();

		$tableData = Datatables::of($nationcloths)
		->editColumn('principle_cloths','<div class="image"><img src="images/uploads/{{ $principle_cloths }}"   width="50px" height="50px">')
		->editColumn('reserve_cloths',  '<div class="image"><img src="images/uploads/{{ $reserve_cloths   }}"   width="50px" height="50px">')
		->editColumn('reserve2_cloths', '<div class="image"><img src="images/uploads/{{ $reserve2_cloths  }}"   width="50px" height="50px">')
		->editColumn('practise_cloths', '<div class="image"><img src="images/uploads/{{ $practise_cloths  }}"   width="50px" height="50px">')

		->addColumn('actions', function ($data)
			{
				return view('partials.actionBtns')->with('controller','nationcloth')->with('id', $data->nationclothID)->render(); });

		if($request->ajax())
				return DatatablePresenter::make($tableData, 'index');
		$nations=Nation::lists('nickname','id');
	 	return view('nationcloth.index')
	   	->with('nations',$nations)
		->with('tableData', DatatablePresenter::make($tableData, 'index'));
	}

	
	public function create()
	{
		//
	}

	
	public function store(Request $request)
	{
		if(
		Input::hasFile('principal') && Input::hasFile('reserve')&&
		Input::hasFile('practise') || Input::hasFile('reserve2'))
		{
		$file = Input::file('principal');
		$filename=time();
		$file->move('images/uploads', $filename);

		$file = Input::file('reserve');
		$filename2=time();
		$file->move('images/uploads', $filename2);

		$file = Input::file('practise');
		$filename4=time();
		$file->move('images/uploads', $filename4);

      	if(Input::hasFile('reserve2'))
      	{
		$file = Input::file('reserve2');
		$filename3=time();
		$file->move('images/uploads', $filename3);
		}

	 	$nationcloth = new Nationcloth;
	 	$nationcloth->nation_id             =$request->nation_id;
	 	$nationcloth->principle_cloths      =$filename;
		$nationcloth->reserve_cloths      	=$filename2;
		$nationcloth->practise_cloths     	=$filename4;
		if(Input::hasFile('reserve2')){
			$nationcloth->reserve2_cloths   =$filename3;
			}

	 	$nationcloth->save();

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

	
	public function show($id)
	{
		//
	}

	
	public function edit(Request $request , $id)
	{
		$nationcloth= Nationcloth::find($id);

		session(['nationclothid'    => $nationcloth->id]);
		session(['principalimage'   => $nationcloth->principle_cloths]);
		session(['reserveimage'     => $nationcloth->reserve_cloths]);
		session(['reserve2image'    => $nationcloth->reserve2_cloths]);
		session(['practiseimage'    => $nationcloth->practise_cloths]);

		if($request->ajax()){
			return response(array('msg' => 'Adding Successfull', 'data'=> $nationcloth->toJson() ), 200)
			->header('Content-Type', 'application/json');
			}
	}

	
	public function update(Request $request)
	{
		$nationcloth= Nationcloth::find(session('nationclothid'));
		if(!empty($_FILES))
		{
		$nationcloth->nation_id   =$request->nation_id;
		if(Input::hasFile('principal'))
		{
			$file = Input::file('principal');
			$filename=time();
			$file->move('images/uploads', $filename);
			$nationcloth->principle_cloths =$filename;
		}
		else
		{
			$nationcloth->principle_cloths =session('principalimage');
		}

		/*//////////////////*/
		if(Input::hasFile('reserve'))
		{
			$file = Input::file('reserve');
			$filename2=$file->getClientOriginalName();
			$file->move('images/uploads', $filename2);
			$nationcloth->reserve_cloths   =$filename2;
		}
		else
		{
			$nationcloth->reserve_cloths   =session('reserveimage');
		}

		/*//////////////////*/
		if(Input::hasFile('practise'))
		{
			$file = Input::file('practise');
			$filename4=$file->getClientOriginalName();
			$file->move('images/uploads', $filename4);
			$nationcloth->practise_cloths =$filename4;
		}
		else{
			$nationcloth->practise_cloths  =session('practiseimage');
			}

	/*//////////////////*/
		if(Input::hasFile('reserve2'))
		{
			$file = Input::file('reserve2');
			$filename3=$file->getClientOriginalName();
			$file->move('images/uploads', $filename3);
			$nationcloth->reserve2_cloths =$filename3;
		}
		else
		{
	 		$nationcloth->reserve2_cloths  =session('reserve2image');
		}

		}
	 	else{
		 	$nationcloth->nation_id             =$request->nation_id;
		 	$nationcloth->principle_cloths    =session('principalimage');
		 	$nationcloth->reserve_cloths      =session('reserveimage');
		 	$nationcloth->practise_cloths     =session('practiseimage');
		 	$nationcloth->reserve2_cloths     =session('reserve2image');

	 		}

	 		$nationcloth->save();

	 	if($request->ajax()){
	 		return response(array('msg' => 'Adding Successfull'), 200)
	 		->header('Content-Type', 'application/json');
	 		}
	}
	
	public function destroy($id)
  	{
		$nationcloth= Nationcloth::find($id);
	 	$nationcloth->delete();
	 	if($request->ajax()){
	 		return response(array('msg' => 'Removing Successfull'), 200)
	 		->header('Content-Type', 'application/json');
	 		}
 		return redirect()->back();
  	}

}
