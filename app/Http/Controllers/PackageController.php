<?php 

namespace App\Http\Controllers;


use App\Models\Service;
use GuzzleHttp\Message\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\View;
use App\Models\Package;
use App\Util;
use App\Util\Constants;

class PackageController extends VioclickController {


	/**
	 * Display a listing of the package.
	 *
	 * @return Response
	 */
	public function index()
	{
		$packages = Package::getAll();
		$data = array('packages' 	=> $packages);
		return view('package.index', $data);
	}
	
	/**
	 * Show the form for creating a new package.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$services = Service::getActiveServices();
		$services = Util::removeEmpty($services);
		
		$data = array('package'  => new Service(), 'services' => $services);
		
		
		return view('package.create')->with($data);
	}
	
	/**
	 * Show the form for creating a new package.
	 *
	 * @return Response
	 */
	public function store()
	{	
		if(Input::get('packageid') > 0 )
		{
			$service = Service::find(Input::get('packageid'));			
		}		
		else
		{
			$service = new Service();
			$service->a02_type = 2;
			//Upload image
			$image = Input::file('photo');
			if( $image)
			{
				$filename  = $this->getCompanyId() . '.' . $image->getClientOriginalExtension();
				$image->move(base_path() . '/images/package/' . $this->getCompanyId(), $filename);
				$service->a02_image = $filename;
			}
			else
				$service->a02_image = Constants::$PACKAGE_DEFAULT_PHOTO;
		
		}
		
		$service->a02_name = Input::get('name');
		$service->a02_description = Input::get('description');		
		$service->a02_price = ((Input::get('price') != "") ? Input::get('price') : NULL );
		$service->a02_status = Input::get('status');
		
		;
		
		$result = $service->save();
		
		$services = Input::get('services');
		$servicesId = [];
		foreach ($services as $serviceid )
		{
			array_push($servicesId, $serviceid);
		}
		
		if(Input::get('packageid') > 0 )
			$service->services()->sync($servicesId);
		else
			$service->services()->attach($servicesId);
	
		if($result)
		{
			if(Input::get('packageid') > 0 )
				\Session::flash('flash_message','The package '.Input::get('name') . ' was successfully updated.');
			else
				\Session::flash('flash_message','The package '.Input::get('name') . ' was successfully created.');
		}			
		else 
			\Session::flash('flash_message','There was an error creating the package');
			
		return $this->index();
	}
	
	
	public function edit($id)
	{
		$package = Service::getPackageById($id);
		
		$services = Service::getActiveServices();
		$services = Util::removeEmpty($services);
		
		//Get team's members
		$servicesSelected = array();
		foreach ($package->services as $service)
		{ $servicesSelected[] = $service->a02_id; }
		
		$package->services2 = $servicesSelected;
		
		$data = array('package'  => $package, 'services' => $services);
		
		return view('package.create')->with($data);
			
	}
	
	public function destroy()
	{
		if(Service::destroy(Input::get("ids")))
			\Session::flash('flash_message','The packages were successfully deleted.');
		else
			\Session::flash('flash_message','There was an error deleting packages');
				
		return $this->index();
				
	}
	
	
}
