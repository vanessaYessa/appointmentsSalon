<?php 

namespace App\Http\Controllers;


use App\Exceptions\EloquentException;
use App\Models\AppointmentStatus;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\View;
use Laracasts\Flash\Flash;

class AppointmentStatusController extends VioclickController {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/
	
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}
	
	/**
	 * Display a listing of the admin.appStatus.
	 *
	 * @return Response
	 */
	public function index()
	{
		$status = AppointmentStatus::getAll();
		
		$statuslist = AppointmentStatus::getActive();
		Session::put('statuslist', $statuslist);
			
		return view('appointment.status', 
				array(	'statuslist' => $status
		));
	}
	
	public function store()
	{
		$appStatusId = Input::get("appStatusId");	
		$message = "";
		if( $appStatusId > 0)
		{
			$appStatus = AppointmentStatus::where('a09_id', '=', $appStatusId)->get()->first();
			$message = 'The status '.Input::get("name").' was successfully updated.';
		}
		else
		{
			$appStatus = new AppointmentStatus();
			$message = 'The status '.Input::get("name").' was successfully added.';
		}
		
		$appStatus->a09_name = Input::get("name");
		$appStatus->a09_color = Input::get("color");
		$appStatus->a09_status = Input::get("status");
		
		$appStatus->save();
		
		\Session::flash('flash_message',$message);
    	return $this->index();
	}

	
	/**
	 * Update the specified status in storage.
	 *
	 * @param  \App\Project $project
	 * @return Response
	 */
	public function changeStatus()
	{
		$appStatus = AppointmentStatus::where('a09_id', '=', Input::get("id") )->get()->first();
	    $appStatus->a09_status = Input::get("status");
	   
	    return \Response::json($appStatus->save());
	}
 
	
	/**
	 * Delete the specified status from storage.
	 *
	 * @param  \App\Project $project
	 * @return Response
	 */
	public function destroy($id)
	{
		$name = "";
		try {
	
			$appStatus = AppointmentStatus::where('a09_id', '=', $id )->get()->first();
	   		$name = $appStatus->a09_name;
	   		$appStatus->delete();
	   		
			\Session::flash('flash_message', 'The status '. $name.' was successfully deleted.');
	
		} catch ( QueryException $e) {
			\Session::flash('error_message', 'Error while deleting '. $name . ': ' . EloquentException::getFKError($e));
		}
		
		return $this->index();
	}
 

}
