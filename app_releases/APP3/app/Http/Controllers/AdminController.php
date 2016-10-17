<?php namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as Route;
use App\Services\DatatablePresenter;
use Auth;
use Clockwork\Support\Laravel\Facade as Clockwork ;


class AdminController extends Controller
 {

/**
*@method [] [construct]([[] [no parameter]<, ...>])
* [<it check into auth if the user is login or not >]
*/

	public function __construct()
	{
		$this->middleware('auth');
	}

/**
*@method [return view] [index]([[object] [$request]<, ...>]) 
*[<if user is employee it will return view with specific pages depending on his role
but if the user role is admin it will return view with all pages >]
*@var [array] [$employees] [<it take array of data about user>]
*@var [array] [$admin] [<it take array of data about admin>]
*@return [view] [<return view partials.actionBtns if user & return view admin.index if admin >]

*/

	public function index(Request $request)
	{
		$employees = User
			::select(array('id', 'name', 'email', 'role'))
			->where('role','!=',Auth::user()->role);
		$tableData = Datatables::of($employees)
			->setRowId(function ($data){	return 'employee_' . $data->id;	})
			->addColumn('actions', function ($data)
					{
						return view('partials.actionBtns')->with('controller','users')->with('id', $data->id)->render();
					});
		$admin=User
     ::select(array('id', 'name', 'email', 'role'))
		 	->where('id','=',Auth::user()->id)->get();

			if($request->ajax())
				return DatatablePresenter::make($tableData, 'admin.index');

		return view('admin.index')
		  ->with('admin',$admin)
			->with('tableData', DatatablePresenter::make($tableData, 'admin.index'));
	}

	public function store(EmployeeRequest $request)
	{

	}

/**
*@method [responce massege] [edit]([[object] [$request],[int] [$id]])
* [<to edit data of user [name,Email, role]>]
*@param [integer] [$id] [<we find with id the user which we need to edit >]
*@return [msg] [<succesful msg of status 200>]
*/

	public function edit(Request $request, $id)
	{
		$employee 	= User::find($id);
 		if($request->ajax()){
 			return response(array('msg' => 'Adding Successfull', 'data'=> $employee->toJson() ), 200)
 								->header('Content-Type', 'application/json');
	}
}
/**
*@method [responce msg] [update]([[object] [$request],[int] [$id]]) 
*[<to update data of user [name,email,role] and save the new data in DB>]
*@return [responce msg] [<succes msg of status 200 >]
*/
	public function update(Request $request, $id)
	{
			$employee = User::find($id);
			$employee->name 	      = $request->name ;
			$employee->email 	      = $request->email ;
			$employee->role 	      = $request->role ;
			$employee->save();
			if($request->ajax())
			{
				return response(array('msg' => 'Adding Successfull'), 200)
									->header('Content-Type', 'application/json');
			}
	}
/**
*@method [view of same page] [update_admin]([[object] [$request]]) 
*[<update data [name ,email,role] of admin >]
*/
	public function update_admin(Request $request)
	{
			$employee = User::find(Auth::user()->id);
			$employee->name 	      = $request->name ;
			$employee->email 	      = $request->email ;
			$employee->role 	      = $request->role ;
			$employee->save();
      return redirect()->back();
	}
/**
*@method [view of same page] [destroy]([[int] [$id]])
* [<delete user >]
*/
	public function destroy($id)
	{
			$employee = User::find($id);
			if(!$employee)
			return 'not found';
			$employee->delete();
			if($request->ajax())
			{
				return response(array('msg' => 'Removing Successfull'), 200)
          			->header('Content-Type', 'application/json');
	    }
		return redirect()->back();
	}

}
/**@copyright 2016 The PHP Team [Amera Helmi,Alaa Ragab, Lamess Said]*/