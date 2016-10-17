<?php namespace App\Services;

// use yajra\Datatables\DatatablePresenter as Datatables;
use Session;

class DatatablePresenter{

	public static function make($tableData, $session_id, $mDataSupport = true, $orderFirst = false)
	{
		if($tableData->request->ajax())
			Session::set($session_id, $tableData->request->all());
		else
			$tableData->request->replace( Session::get($session_id, ['length'=> 10, 'start'=> 0]) );

		return $tableData->make($mDataSupport, $orderFirst);
	}

}
