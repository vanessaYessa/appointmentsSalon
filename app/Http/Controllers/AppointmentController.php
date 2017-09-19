<?php 

namespace App\Http\Controllers;


use App\Models\Appointment;
use App\Models\AppointmentStatus;
use App\Models\Client;
use App\Models\Service;
use App\Models\Source;
use App\Models\User;
use App\Util;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View;
use Laracasts\Flash\Flash;
use Carbon\Carbon;


class AppointmentController extends VioclickController {

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
	 * Display a listing of the admin.sourceStatus.
	 *
	 * @return
	 */
	public function index()
	{
		$companyId = $this->getCompanyId();
		
		$users = User::getActive();
		$users = Util::removeEmpty($users);
		
		$status = AppointmentStatus::getActive();
		$statuslist = AppointmentStatus::getAllActive();
		$services = Service::getActiveServices();
		$services = Util::removeEmpty($services);
		
		$calendaruserid = (Input::get("calendaruserid") > 0 ) ? Input::get("calendaruserid") : -1;
		//$statusType = ProspectType::getActive($companyId);
		//$source = 2;
		
		$userlist = User::getAllActive();
		
		return view('appointment.index' ,
				array(	'users' => $users,
						'status' => $status,
						'services' => $services,
						'statuslist' => $statuslist,
						'calendaruserid' => $calendaruserid,
						'userlist' => $userlist
				));
	}
	
	
	public function appsByUser()
	{
		$companyId = $this->getCompanyId();
	
		$users = User::getActive();
		$status = AppointmentStatus::getActive();
	
		$services = Service::getActiveServices();
	
		$calendaruserid = (Input::get("calendaruserid") > 0 ) ? Input::get("calendaruserid") : -1;
		//$statusType = ProspectType::getActive($companyId);
		//$source = 2;
	
		$userlist = User::getAllActive();
	
		return view('appointment.index2' ,
			array(	'users' => $users,
					'status' => $status,
					'services' => $services,
					'calendaruserid' => $calendaruserid,
					'userlist' => $userlist
			));
	}
	
	
	
	/**
	 * 
	 *
	 * @param  \App\Project $project
	 * @return
	 */
	public function getAppointments()
	{		
		$startDate = Input::get("start");
		$endDate = Input::get("end");
		$calendaruserid = Input::get("userid");
			
		Session::put('calendar_start', $startDate);
		Session::put('calendar_end', $endDate);
		
		$appList;
		if($calendaruserid > 0)
		{
			$appList = Appointment::getByUser(
					$this->getRoleId(), $startDate, $endDate, $calendaruserid);
			
			if(count($appList) == 0)
				$appList = array(["username" => User::find($calendaruserid)->a01_username]);
		}
		
		else 
			$appList = Appointment::getByCompany(
					$this->getRoleId(), $startDate, $endDate, $this->getId());
			
		return \Response::json($appList);
	}
	
	
	/**
	 * 
	 *
	 * @return
	 */
	public function getResumen()
	{
		$startDate = Session::get('calendar_start');
		$endDate = Session::get('calendar_end'); 

		Session::forget('calendar_start');
		Session::forget('calendar_end');
		
		$companyId = $this->getCompanyId();
	    return \Response::json(Appointment::getByResumen($companyId, $this->getRoleId(), $startDate, $endDate, $this->getId()));
	}
	
	
	
	public function store()
	{
		$appointment = new Appointment();
		$appId = Input::get('appointmentid');
		if($appId == "")
		{
			$appointment->a06_status= 1;
			$appointment->a06_creationuser= 1; //$this->getId();
			$appointment->a06_creationdate= Util::getCurrentTime();
			$appointment->a06_comments= Input::get('comments');
			$appointment->a06_commentsresult= Input::get('commentsresult');
		}
		else 
		{
			$appointment = Appointment::find($appId);
			$appointment->a06_status=  Input::get('statusid');
		}
			
		if(Input::get('clientid') == "" || Input::get('clientid') == 0)
		{
			$phone = Util::getPhoneNumber(Input::get('phone'));
			$client = ClientController::validateClient($phone);
			
			if($client == null)
			{
				$client = new Client();
				$client->a05_name = Input::get('client');
				$client->a05_mobile = $phone;
				$client->a05_status = 1;
			}
			
			$client->save();
			$appointment->a06_clientid = $client->a05_id;
		}
		else
			$appointment->a06_clientid = Input::get('clientid');
		
		$appointment->a06_startdate= Util::changeStringFormatToDate(Input::get('startdate'));
		$appointment->a06_enddate= Util::changeStringFormatToDate(Input::get('enddate'));
		$appointment->a06_description= Input::get('title');
		$appointment->a06_userid= Input::get('userid');
		$appointment->a06_starttime= Util::changeStringTime(Input::get('time')); 
		$appointment->a06_endtime= Util::changeStringTime(Input::get('timeend'));
		$appointment->save();
		
		
		return redirect('appointments');
    	
	}
	
	public function storeMassive()
	{
		try{
		
			$clientId = 0;	
		
		if(Input::get('clientid') == "" || Input::get('clientid') == 0)
		{
			$phone = Util::getPhoneNumber(Input::get('phone'));
			$client = ClientController::validateClient($phone);
				
			if($client == null)
			{
				$client = new Client();
				$client->a05_name = Input::get('name');
				$client->a05_lastname = (Input::get('lastname') != "" ? Input::get('lastname') : "");
				$client->a05_mobile = $phone;
				$client->a05_gender = (Input::get('gender') != null ? Input::get('gender') : 'female');
				$client->a05_dob = (Input::get('dob') != null ? Util::changeStringFormatToDate(Input::get('dob')) : null);
				$client->a05_email = (Input::get('email') != null ? Input::get('email') : null);
				$client->a05_status = 1;
				$client->save();
			}
			$clientId = $client->a05_id;
			
		}
		else
			$clientId = Input::get('clientid');
			
		//Get services & stylist
		for ($i = 1; $i < count(Input::get('services')); $i++) 
		{	
			$appointment = new Appointment();
			$appointment->a06_status= 1;
			$appointment->a06_creationuser= $this->getId();
			$appointment->a06_creationdate= Util::getCurrentTime();
			$appointment->a06_comments= Input::get('comments');
			$appointment->a06_userid= Input::get('stylist')[$i];
			$appointment->a06_serviceid = Input::get('services')[$i];
			$appointment->a06_description= Input::get('name') . " " . Input::get('lastname') . " - " . Input::get('associate')[$i];
			$appointment->a06_startdate= Util::changeStringFormatToDate(Input::get('startdate'));
			$appointment->a06_enddate= Util::changeStringFormatToDate(Input::get('startdate'));
			
			$startTime = Util::changeStringTime(Input::get('starttime')[$i]);
			$appointment->a06_starttime= $startTime;
						
			//Get duration according to the user
			$endTime = Carbon::createFromFormat('H:i:s', $startTime);
			$endTime->addMinutes(Input::get('duration')[$i]);
			$appointment->a06_endtime= $endTime;
			
			//Get duration according to system
			//$appointment->a06_endtime= Util::changeStringTime(Input::get('endtime')[$i]);
			$appointment->a06_clientid = $clientId;
			$appointment->save();
		};
		
		\Session::flash('flash_message', 'The appointment was succefully created.');
		
		} catch ( QueryException $e) {
			\Session::flash('error_message', 'There was an error while creating appointments ');
			Log::error($e);
		}
		
    	return $this->index();
	}

	/**
	 * 
	 *
	 * @param  
	 * @return
	 */
	public function getById()
	{
		$appointment = Appointment::getById(Input::get("id"));
		return \Response::json($appointment);
	}
	
	/**
	 *
	 *
	 * @param
	 * @return
	 */
	public function getByClient()
	{
		$todayDate =Input::get("dateapp");
		if(Input::get("dateapp") == "")
			$todayDate = Util::getCurrentDate();
		
		$appointment = Appointment::getByClient(Input::get("id"), $todayDate);
		return \Response::json($appointment);
	}
	
	
	/**
	 * Delete the specified source from storage.
	 *
	 * @param  \App\Project $project
	 * @return
	 */
	public function destroy($id)
	{
		try {
	
			$appointment = Appointment::where('a06_id', '=', $id )->get()->first();
	   		$appointment->delete();
	   		
			\Session::flash('flash_message', 'The appoitment was successfully deleted.');
	
		} catch ( QueryException $e) {
			\Session::flash('error_message', 'Error while deleting appointment ');
		}
		
		return redirect('appointments');
	}

	
	/**
	 *
	 *
	 * @param  \App\Project $project
	 * @return
	 */
	public function getAppointmentsToday()
	{
		$startDate = Util::getCurrentDate();
		$endDate = Util::getCurrentDate();
		$userId = Input::get("userId");
		$companyId = $this->getCompanyId();
	
		return \Response::json(Appointment::getByCompany($companyId,
				$this->getRoleId(), $startDate, $endDate, $userId));
	}
	
	
	/**
	 *
	 *
	 * @param  \App\Project $project
	 * @return
	 */
	public function checkDisponibility()
	{
		$serviceId = Input::get("service");
		$userId = Input::get("user");
		$services = array();
		
		$service = Service::getById($serviceId);
		//Service
		
		if($service->a02_type == 2)
		{
			foreach($service->services as $serviceA)
			{
				array_push($services, $serviceA);
			}
		}
		else
			array_push($services, $service) ;
		
		
		$user = User::find($userId);
		
		return \Response::json(array('user' => $user, 'services' => $services));
	}

	
	public function updateByClientId()
	{	
		//$appointments = Appointment::getByClient(Input::get("clientid"), Input::get("startdate"));
		
		$appointmentArray = Input::get("appointmentid");
		$flagCreateInvoice = false;
		
		//Can change everything 
		if(Input::get('statusid') == 1)
		{	
			//Create sale
			for ($i = 0; $i < count($appointmentArray); $i++)
			{
				$appointment = Appointment::find($appointmentArray[$i]);
				$appointment->a06_startdate= Util::changeStringFormatToDate(Input::get('startdate'));
				$appointment->a06_enddate= Util::changeStringFormatToDate(Input::get('startdate'));
				$appointment->a06_starttime= Util::changeStringTime(Input::get('starttime')[$i]);
				$appointment->a06_endtime= Util::changeStringTime(Input::get('endtime')[$i]);
				$appointment->a06_modificationuser = $this->getId();
				$appointment->a06_modificationdate = Util::getCurrentTime();
				$appointment->a06_status=  Input::get('statusid');
				$appointment->a06_commentsresult= Input::get('commentsresult');
				$appointment->save();
			}
		}
		else
		{
			$aservicios = array();
			
			//Create sale
			for ($i = 0; $i < count($appointmentArray); $i++)
			{
				$appointment = Appointment::find($appointmentArray[$i]);
				if( Input::get('statusid') == 2 && $appointment->a06_modificationuser == null)
				{
					$flagCreateInvoice = true;
					array_push($aservicios, array ($appointment->a06_userid, $appointment->a06_serviceid));
				}
				
				$appointment->a06_modificationuser = $this->getId();
				$appointment->a06_modificationdate = Util::getCurrentTime();
				$appointment->a06_status = Input::get('statusid');
				$appointment->save();
			}
			
			//Can change everything
			if($flagCreateInvoice)
			{
				Session::put('servicios', $aservicios);
				$saleController = new SaleController();
				return $saleController->create(Input::get("clientid"));
			}
			
			Session::flash('flash_message', 'The appoitment was successfully updated.');
			return $this->index();
		}
	}
	
	
	public static function getTodayAppointment()
	{
		$userid = -1;
	
		$appointments = Appointment::whereDate("a06_startdate", "=" , Util::getCurrentDate())->
					orderBy('a06_startdate', 'asc');
	
		return \Response::json($appointments->get());
	}
	
}
