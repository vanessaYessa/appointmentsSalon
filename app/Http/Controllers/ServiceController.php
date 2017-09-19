<?php 

namespace App\Http\Controllers;


use App\Models\Service;
use GuzzleHttp\Message\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\View;
use App\Util\Constants;

class ServiceController extends VioclickController {

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
	 * Display a listing of the service.
	 *
	 * @return Response
	 */
	public function index()
	{
		$services = Service::getAll();
		$data = array('services' 	=> $services);
		return view('service.index', $data);
	}
	
	/**
	 * Show the form for creating a new service.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$data = array('service'  => new Service());
		return view('service.create')->with($data);
	}
	
	/**
	 * Show the form for creating a new service.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Input::get('serviceid') > 0 )
		{
			$service = Service::find(Input::get('serviceid'));
		}		
		else
		{
			$service = new Service();
			$service->a02_type = 1;			
		}
		
		$service->a02_name = Input::get('name');		
		$service->a02_description = Input::get('description');
		$service->a02_price = ((Input::get('price') != "") ? Input::get('price') : NULL );
		$service->a02_status = Input::get('status');
		$service->a02_duration = Input::get('followup');
		$service->a02_durationscale = 1;
		
		//Upload image
		$image = Input::file('photo');
		if( $image)
		{
			$filename  = $this->getCompanyId() . '.' . $image->getClientOriginalExtension();
			$image->move(base_path() . '/images/service/' . $this->getCompanyId(), $filename);
			$service->a02_image = $filename;
		}
		else
			$service->a02_image = Constants::$SERVICE_DEFAULT_PHOTO;
	
		if($service->save())
			\Session::flash('flash_message','The service '.Input::get('name') . ' was successfully created.');
		else 
			\Session::flash('flash_message','There was an error creating the service');
			
		return redirect('service');
	}
	
	
	public function edit($id)
	{
		$service = Service::find($id);	
		$data = array('service'  => $service);
		
		return view('service.create')->with($data);
			
	}
	
	public function destroy()
	{
		if(Service::destroy(Input::get("ids")))
			\Session::flash('flash_message','The services were successfully deleted.');
		else
			\Session::flash('flash_message','There was an error deleting services');
				
		return view('service');
				
	}
	
	
}
