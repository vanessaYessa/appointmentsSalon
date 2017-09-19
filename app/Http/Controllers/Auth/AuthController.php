<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use App\Models\AppointmentStatus;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	
	/**
	 * Handle an authentication attempt.
	 *
	 * @return Response
	 */
	public function authenticate(LoginFormRequest $request)
	{
		$pswd = trim($request->password);
		$username = trim($request->username);
		
		dd(Hash::make ( $pswd));
		
		dd(Auth::attempt(['a01_username' => $username, 'a01_password' => $pswd]));
		if (Auth::attempt(['a01_username' => $username, 'a01_password' => $pswd]))
		{
			$user = User::getUser($request->username); 
			$user = $user->toArray();			
			
			$statuslist = AppointmentStatus::getActive();
			Session::put('statuslist', $statuslist);
			
			//Active status
			if($user['a104_status'] == 1 )
			{		
				Session::put('active_user', $user); 
				/* Session::put('menu_user', Menu::getByRoleId($user['a104_roleid'], 1));
				Session::put('menu_superior', Menu::getByRoleId($user['a104_roleid'], 2)); 
				
				//Company Admin Role
				if($user['a104_roleid'] == 2)
				{
					if($user['a104_id'] >= 108 || $user['a104_id'] == 71  || $user['a104_id'] == 109 || $user['a104_id'] == 111 )
					{
						
					}
					else
					{
						return redirect('dashboard');
					}
				}
				 
				//Team Admin Role
				if($user['a104_roleid'] == 3)
				{
					$arrayAssociated = Associate::getAssociatesbyTeam($user['a104_id']);
				} */
				
				return redirect('dashboard');
			}
			else
			{
				$errors = new MessageBag(['password' => ['User no active']]);
				return Redirect::back()->withErrors($errors)->withInput();
			}
	
		}
		else
		{
			$errors = new MessageBag(['password' => ['Email and/or password invalid.']]);
			return Redirect::back()->withErrors($errors)->withInput();
		}		
	}
	

	public function logOut()
	{
		// Cerramos la sesion
		Auth::logout();
		// Volvemos al login y mostramos un mensaje indicando que se cerr� la sesi�n
		return Redirect::to('/');
	}

}
