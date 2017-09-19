<?php 

namespace App\Http\Controllers;


use App\Exceptions\EloquentException;
use App\Models\User;
use App\Util\Constants;
use GuzzleHttp\Message\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\View;

class UserController extends VioclickController {

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
	 * Display a listing of the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		$data = array('users' 	=> $users);
		return view('user.index', $data);
	}
	
	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$data = array('user'  => new User());
		return view('user.create')->with($data);
	}
	
	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User();
		
		if(Input::get('userid') > 0 )
		{
			$user = User::find(Input::get('userid'));
		}	
		
		$user->a01_name = ucfirst(Input::get('name'));
		$user->a01_lastname = ucfirst(Input::get('lastname'));
		$user->a01_roleid = Input::get('role');
		$user->a01_phone = Input::get('phone');
		$user->a01_calendarcolor = Input::get('color');
		$user->a01_status = Input::get('status');
		$user->a01_showcalendar = Input::get('showcalendar');
		
		//Upload image
		$image = Input::file('photo');
		
		if( $image)
		{
			$filename  =  ucfirst(Input::get('name')) . '.' .$image->getClientOriginalExtension();
			$image->move(base_path() . '/images/user/' , $filename);
			$user->a01_image = $filename;
		}
		else
			$user->a01_image = Constants::$USER_DEFAULT_PHOTO;
		

			
		$user->a01_username = (Input::get('username') != "" ? Input::get('username') : null);
		if(Input::get('password') != "")
		{
			$user->a01_password = Hash::make ( Input::get('password'));
			Log::info("creating---> " . $user->a01_password);
		}
		
		if($user->save())
			\Session::flash('flash_message','The member '.Input::get('name') . ' '. Input::get('lastname').' was successfully created.');
		else 
			\Session::flash('flash_message','There was an error creating the user');
			
		return redirect('user');
	}
	
	
	public function edit($id)
	{
		$user = User::find($id);	
		$data = array('user'  => $user);
		
		return view('user.create')->with($data);
			
	}
	
	
	public function destroy()
	{
		try {
		
			if(User::destroy(Input::get("ids")))
				\Session::flash('flash_message','The users were successfully deleted.');
			else
				\Session::flash('flash_message','There was an error deleting users');
				
		} catch ( QueryException $e) {
			\Session::flash('flash_message', 'Error while deleting users: ' . EloquentException::getFKError($e));
		}
			
		return $this->index();
			
	}
	
	
}
