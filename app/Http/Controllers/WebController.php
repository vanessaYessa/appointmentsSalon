<?php 

namespace App\Http\Controllers;


use App\Http\Requests\CompanyExpressFormRequest;
use App\Http\Requests\WebFormRequest;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View;

class WebController extends VioclickController {

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
	
	 *
	 * @return Response
	 */
	public function signup()
	{
		return view('signup');
	}
	
	/**
	 *
	 *
	 * @return Response
	 */
	public function signin()
	{
		return view('login');
	}
	
	/**
	 * 
	 * @param CompanyExpressFormRequest $request
	 */
	public function store(WebFormRequest $request)
	{	
		//Create user
		$user = new User;
		$encPassword = Hash::make($request->password);
		$user->a01_password = $encPassword;
		$user->a01_name = Input::get('name');
		$user->a01_lastname = Input::get('lastname');
		$user->a01_phone = Input::get('lastname');
		$user->a01_username = "admin";
		$user->a01_roleid = 1;
		$user->a01_status = 1;
		$user->save(); 
		
		Auth::login($user);
	
		return view('dashboard');
	}
	
	
	public function sendVerificationEmail()
	{
		$fullName = Session::get('name');
		$verificationNumber = Session::get('code');
		$email = Session::get('email');
		$sent = Mail::send('emails.welcome',
				array('fullName' => $fullName, 'verificationNumber' => $verificationNumber),
				function ($message) use ($email)
				{
					$message->to($email)
							->subject('Welcome to CRichness!');
				}
		);
		return \Response::json($sent);
	}
	
	public function activateAccount()
	{
		return view('verify');
	}
	
	
}
