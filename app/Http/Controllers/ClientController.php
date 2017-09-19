<?php 

namespace App\Http\Controllers;


use App\Http\Requests\ClientRequestForm;
use App\Models\Client;
use App\Models\ContactType;
use App\Models\FollowUp;
use App\Models\Sale;
use App\Models\User;
use App\Util;
use GuzzleHttp\Message\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\View;

class ClientController extends VioclickController {

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
	 * Display a listing of the client.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = array();
		$request = array();
		
		/* array_push($request,Input::get("associates"));
		if(Input::get("associates")){
			array_push($filter, array ('a103_assistedby', '=', Input::get("associates")));
		} */
		
		array_push($request,Input::get("namef"));
		if(Input::get("namef")){
			array_push($filter, array ('a05_name', 'LIKE', Input::get("namef")));
		}
		
		array_push($request,Input::get("phonef"));
		if(Input::get("phonef")){
			array_push($filter, array ('a05_mobile', '=', Util::getPhoneNumber(Input::get("phonef"))));
		}
		
		array_push($request,Input::get("stylist"));
		if(Input::get("stylist")){
			array_push($filter, array ('a05_belongsto', '=', Input::get("stylist")));
		}
		
		$clients = Client::getAll($this->getRoleId(), $this->getId(), $filter);
		
		$data = array('clients' => $clients, 'filter' => $request, 'users' => User::getActive());
		return view('client.index', $data);
	}
	
	/**
	 * Show the form for creating a new client.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$users = User::getActive();

		$data = array('client'  => new Client(), "users" => $users);
		return view('client.create')->with($data);
	}
	
	/**
	 * Show the form for creating a new client.
	 *
	 * @return Response
	 */
	public function store(ClientRequestForm $request)
	{
		$message = " was successfully created.";
		if(Input::get('clientid') > 0 )
		{
			$client = Client::find(Input::get('clientid'));
			$message = " was successfully updated.";
		}		
		else
		{	
			$verify = $this->validateClient(Util::getPhoneNumber(Input::get('mobile')));
			
			if($verify == null)
			{
				$client = new Client();
				$client->a105_creationdate = Util::getCurrentTime();
			}
			else 
				$client = $verify;
		}
				
		$client->a05_name = Input::get('name');
		$client->a05_lastname = (Input::get('lastname') != "" ? Input::get('lastname') : "");
		$client->a05_mobile = Util::getPhoneNumber(Input::get('mobile'));
		$client->a05_gender = (Input::get('gender') != "" ? Input::get('gender'): null);
		$client->a05_comments = Input::get('comments');
		$client->a05_phone = (Input::get('phone') != "" ? Util::getPhoneNumber(Input::get('phone')) : "");
		$client->a05_dob = (Input::get('dob') != "" ? Util::changeStringFormatToDate(Input::get('dob')) : null); 
		$client->a05_email = (Input::get('email') != "" ? Input::get('email') : ""); 
		$client->a05_status = Input::get('status');
		$client->a05_belongsto = (Input::get('belongto') != null ? Input::get('belongto') : null);
		
		$client->a05_calleverynumber = (Input::get('callevery') != "" ? Input::get('callevery') : null);
		$client->a05_calleveryperiod = (Input::get('calleveryperiod') != "" ? Input::get('calleveryperiod') : null);
		$client->a05_followupdate = (Input::get('followupdate') != "" ? Util::changeStringFormatToDate(Input::get('followupdate')) : null);
		$client->a05_followupcomment = (Input::get('followupcomments') != "" ? Input::get('followupcomments') : null);
				
		if($client->save())
			\Session::flash('flash_message','The client '.Input::get('name') . ' '. Input::get('lastname'). $message);
		else 
			\Session::flash('error_message','There was an error creating the client');
			
		return redirect('client');
	}
	
	
	public function edit($id)
	{
		$client = Client::find($id);
		
		$contactMethod = ContactType::getActive();
		
		$followup = FollowUp::getByClientId($client->a05_id);
		$sales = Sale::getByClientId($client->a05_id);
		$users = User::getActive();
		
		$data = array('client'  => $client, 
					'followups'  => $followup, 
					'sales'  => $sales,
				 	"contactMethod" => $contactMethod,
					"users" => $users);
		
		return view('client.create')->with($data);
			
	}
	
	public function destroy()
	{
		if(Client::destroy(Input::get("ids")))
			\Session::flash('flash_message','The clients were successfully deleted.');
		else
			\Session::flash('flash_message','There was an error deleting clients');

		return $this->index();
	
	}
	
	
	/**
	 *
	 * @return Response
	 */
	public function getProspectList()
	{
		$name = Input::get('name');
		$phone = Input::get('phone');
		$phone = Util::getPhoneNumber($phone);
		
		$clients = Client::where('a05_status', '=', 1);
		
		if($name != "")
			$clients->where(function ($clients) use ($name) {
				$clients->where('a05_name', 'like', '%' .$name  . '%')->
				orWhere('a05_lastname', 'like', '%' . $name . '%');
			});
		
		if($phone != "")
			$clients->where('a05_mobile', '=', $phone);
	
		return \Response::json($clients->get());
	}
	
	/**
	 *
	 * @return Response
	 */
	public function getClientDetail($clientid)
	{
		return \Response::json(Client::getLastDetails($clientid));
	}
	
	public function getClientByPhone($phone)
	{
		$phone = Util::getPhoneNumber($phone);
		
		return \Response::json($this->validateClient($phone));
	}
	
	
	public function storeExpress()
	{	
		$verify = $this->validateClient(Util::getPhoneNumber(Input::get('phone')));
			
		if($verify == null)
		{
			$client = new Client();
			$client->a105_creationdate = Util::getCurrentTime();
			$client->a05_name = Input::get('name');
			$client->a05_lastname = (Input::get('lastname') != "" ? Input::get('lastname') : "");
			$client->a05_mobile = Util::getPhoneNumber(Input::get('phone'));
			$client->a05_status = 1;
			$client->save();
		}
		else
		{
			$client = $verify;
		}
			
		return \Response::json($client);
	}
	
	
	
	public static function validateClient($phone)
	{ 
		$client = Client::where('a05_mobile', '=', $phone)->get()->first();
		
		if( $client )
			return $client;
		else 
			return null;
	}
	
	
	
	
}
