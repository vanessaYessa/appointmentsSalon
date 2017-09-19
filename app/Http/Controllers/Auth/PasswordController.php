<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\Associate;
use App\Models\User;
use App\Http\Requests\PasswordFormRequest;
use App\Http\Requests\EmailFormRequest;
use App\Util;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;

		$this->middleware('guest');
	}

	

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function forgetPassword()
	{
		return view('user/forget');
	}
	
	
	/**
	 * Change password
	 *
	 * @return Response
	 */
	public function resetPassword(EmailFormRequest $request)
	{
		$email = $request->email;
		//Generate and save validation code for user
		$user = User::where('a01_username', '=', $email)->get()->first();
		
		if($user != null)
		{
			$randomPassword = Util::generatePassword ();
			
			$user->a01_password = Hash::make ( $randomPassword );
			$user->a01_status = 3;
			$user->save();
			
			$associate = Associate::where('a102_id', '=',$user->a104_id )->get()->first();
			
			$emailContent = array(
					'fullName' => $associate->a102_name . ' '. $associate->a102_lastname,
					'randomPassword' => $randomPassword,
					'userMail' => $email);
			 
			$sent = Mail::send('emails.password',
					$emailContent,
					function ($message) use ($email)
					{
						$message->to($email)
						->subject('Reset your Colamerica password');
					}
			);
			 
			\Session::flash('flash_message','You will receive an email from us with instructions for resetting your password. ');
			return view('login');
		}
	}
	
	
}
