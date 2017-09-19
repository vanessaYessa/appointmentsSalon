<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Session;

class VioclickController extends Controller {

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
	 * Display a listing of the states.
	 *
	 * @return Response
	 */
	public static function getRoleId()
	{
		$userSession = Session::get('active_user');
		if($userSession != null)
		{
			return $userSession['a104_roleid'];
		}
		else
		{
			\Session::flash('error_message','There is no valid session');
			return redirect('/');
		}
	}
	
	
	
	/**
	 * Display a listing of the states.
	 *
	 * @return Response
	 */
	public static function getId()
	{
		/*$userSession = Session::get('active_user');
		
		if($userSession != null)
		{
			return $userSession['a104_id'];
		}
		else
		{
			\Session::flash('error_message','There is no valid session');
			return redirect('/');
		}*/
		
		return 1;
	}
	
	
	/**
	 * Display a listing of the states.
	 *
	 * @return Response
	 */
	public static function getEmail()
	{
		$userSession = Session::get('active_user');
	
		if($userSession != null)
		{
			return $userSession['a104_email'];
		}
		else
		{
			\Session::flash('error_message','There is no valid session');
			return redirect('/');
		}
	}
	
	public static function getName()
	{
		$userSession = Session::get('active_user');
	
		if($userSession != null)
		{
			return $userSession['a102_name'] . " " . $userSession['a102_lastname'];
		}
		else
		{
			\Session::flash('error_message','There is no valid session');
			return redirect('/');
		}
	}
	
	
	/**
	 * Display a listing of the states.
	 *
	 * @return Response
	 */
	public static function getCompanyId()
	{
		$userSession = Session::get('active_user');
		if($userSession != null)
		{
			//Super admin
			if($userSession['a104_roleid'] == 1 )
				return NULL;
				//Administrator or less
				if($userSession['a104_roleid'] >= 2 )
					return $userSession['a102_companyid'];
		}
		else
		{
			\Session::flash('error_message','There is no valid session');
			return redirect('/');
		}
	}
	
}
