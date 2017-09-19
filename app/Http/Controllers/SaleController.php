<?php 

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Service;
use App\Models\User;
use App\Util;
use GuzzleHttp\Message\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\View;
use App\Models\SaleDetail;
use App\Models\Client;
use Illuminate\Support\Facades\Session;
use App\Models\Inventory;
use App\Models\Payment;

class SaleController extends VioclickController {

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
	 * Display a listing of the sale.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$sales = Sale::getAll($this->getRoleId(), $this->getId(), array());
		$data = array('sales' 	=> $sales); 
		return view('sale.index', $data);
	}
	
	/**
	 * Show the form for creating a new sale.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$users = User::getActive();		
		$services = Service::getActiveServices();
		$serviceprice = Service::getActiveServices();
		
		$inventories = Inventory::getExistence();
		
		
		$servicesSelected = Session::get('servicios');
		
		if(Input::get("id") > 0)
			$client = Client::find(Input::get("id"));
		else
			$client = new Client();
		
		$data = array('sale'  => new Sale(),
				'users' => $users,
				'services' => $services,
				'servicios' => $servicesSelected,
				'serviceprice' => $serviceprice,
				'client' => $client,
				'inventories' => $inventories,
		);
		return view('sale.create')->with($data);
	}
	
	/**
	 * Show the form for creating a new sale.
	 *
	 * @return Response
	 */
	public function store()
	{
		$sale = new Sale();
			
		if(Input::get('saleid') > 0 )
		{
			$sale = Sale::find(Input::get('saleid'));
		}		
		else
		{
			$sale->a07_creationuser = 1; //$this->getId();
			$sale->a07_creationdate = Util::getCurrentTime();;
		}
		
		$sale->a07_date = Util::changeStringFormatToDate(Input::get('invoicedate'));
		$sale->a07_clientid = Input::get('clientid');		
		$sale->a07_totalvalue = Input::get('total');
		$sale->a07_status = Input::get('status');
		$sale->a07_tip = Input::get('tip');
		$sale->a07_comment = Input::get('comment');
		$insert = $sale->save();
		
		$arrayservice = Input::get('serviceid');
		$arraycost = Input::get('cost');
		$arrayquantity = Input::get('quantity');
		$arraystylist = Input::get('stylist');
		
		for ($x = 0; $x < count($arrayservice); $x++)
		{
			$saleDetail = new SaleDetail();
			$saleDetail->a08_saleid = $sale->a07_id;
			$saleDetail->a08_serviceid = $arrayservice[$x];
			$saleDetail->a08_price = $arraycost[$x];
			$saleDetail->a08_quantity = $arrayquantity[$x];
			$saleDetail->a08_userid= $arraystylist[$x];					
			$saleDetail->save();
		}
		
		
		$inventoryid = Input::get('inventoryid');
		$arraycost = Input::get('costinv');
		$arrayquantity = Input::get('quantityinv');
		
		for ($x = 0; $x < count($arrayservice); $x++)
		{
			$saleDetail = new SaleDetail();
			$saleDetail->a08_saleid = $sale->a07_id;
			$saleDetail->a08_inventoryid = $inventoryid[$x];
			
			$inventory = Inventory::find($inventoryid[$x]);
			$inventory->a15_quantity = $inventory->a15_quantity - $arrayquantity[$x];
			
			$saleDetail->a08_price = $arraycost[$x];
			$saleDetail->a08_quantity = $arrayquantity[$x];
			$saleDetail->save();
		}
				
		if($insert)
			\Session::flash('flash_message','The sale was successfully created.');
		else 
			\Session::flash('error_message','There was an error creating the sale');
			
		return redirect('sale');
	}
	
	
	public function edit($id)
	{
		$sale = Sale::find($id);	
		$data = array('sale'  => $sale);
		
		return view('sale.create')->with($data);
			
	}
	
	
	public function show($id)
	{
		$sale = Sale::getById($id);
		$users = User::getActive();
		
		$data = array('sale'  => $sale, 'users'  => $users);
	
		return view('sale.show')->with($data);
			
	}
	
	public function destroy()
	{
		if(Sale::destroy(Input::get("ids")))
			\Session::flash('flash_message','The sales were successfully deleted.');
		else
			\Session::flash('flash_message','There was an error deleting sales');

		return $this->index();
	
	}
	
	
	
	/**
	 * Show the form for creating a new sale.
	 *
	 * @return Response
	 */
	public function storePayment()
	{
		$payment = new Payment();
			
		if(Input::get('paymentid') > 0 )
		{
			$payment = Payment::find(Input::get('paymentid'));
		}
		else
		{
			$payment->a16_creationuser = $this->getId();
			$payment->a16_creationdate = Util::getCurrentTime();
		}
	
		$payment->a16_date = Util::changeStringFormatToDate(Input::get('date'));
		$payment->a16_comment = Input::get('comment');
		$payment->a16_saleid = Input::get('saleid');
		$payment->a16_amount = Input::get('amount');
		$payment->a16_userid = Input::get('userid');
		$payment->save();
		
		//Return all payments, to show them at the same page
		return $this->show(Input::get('saleid'));
	}
	
	public function destroyPayment($id)
	{
		$payment = Payment::find($id);
		$paymentId = $payment->a16_saleid;
		
		if($payment::destroy($id))
			\Session::flash('flash_message','The payment was successfully deleted.');
		else
			\Session::flash('flash_message','There was an error deleting payment');
	
		return $this->show($paymentId);
	
	}
		
}
