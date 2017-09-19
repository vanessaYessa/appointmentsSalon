<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View;
use App\Models\Inventory;
use Illuminate\Support\Facades\Input;
use App\Util;


class InventoryController extends VioclickController {

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
	public function index()
	{		
		$inventories = Inventory::getAll($this->getRoleId(), $this->getId()); 
		$data = array('inventories' => $inventories); //, 'filter' => $request
		
		return view('inventory.index', $data);
	} 
	
	
	/**
	 *
	 * @return Response
	 */
	public function destroy()
	{
		$data = array(); //'inventorys' => $inventorys, 'filter' => $request
	
		return view('inventory.index', $data);
	}
	
	
	
	/**
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = array('inventory' => new Inventory()); //, 'filter' => $request
	
		return view('inventory.create', $data);
	}
	
	
	/**
	 *
	 * @return Response
	 */
	public function store()
	{
		$message = " was successfully created.";
		if(Input::get('inventoryid') > 0 )
		{
			$inventory = Inventory::find(Input::get('inventoryid'));
			$message = " was successfully updated.";
			$inventory->a15_modificationdate = Util::getCurrentTime();
			$inventory->a15_modificationuser = $this->getId();
		}
		else
		{
			$inventory = new Inventory();
			$inventory->a15_creationdate = Util::getCurrentTime();
			$inventory->a15_creationuser = $this->getId();
		}
		
		$inventory->a15_name = Input::get('name');
		$inventory->a15_description = (Input::get("description") != "" ) ? Input::get("description") : null;
		$inventory->a15_price = Input::get('price');
		$inventory->a15_brand = Input::get('brand');
		$inventory->a15_quantity = Input::get('quantity');
		$inventory->a15_type = Input::get('type');
		$inventory->a15_status = Input::get('status');
		
		
		if($inventory->save())
			\Session::flash('flash_message','The inventory '.Input::get('name') . ' '. Input::get('lastname'). $message);
		else
			\Session::flash('error_message','There was an error creating the inventory');
					
		return redirect('inventory');
	}
	
	
	/**
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$inventory = Inventory::find($id);
		
		$data = array('inventory' => $inventory);
	
		return view('inventory.create', $data);
	}
}
