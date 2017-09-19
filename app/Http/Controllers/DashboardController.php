<?php 

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Response;
use Illuminate\View;
use App\Models\Service;
use App\Util;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Sale;
use Illuminate\Support\Facades\Input;


class DashboardController extends VioclickController {

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
		return view('dashboard');
	} 
	
	
	public static function getSales()
	{
		$startdate =  Util::changeStringFormatToDate(Input::get("startdate"));
		$enddate = Util::changeStringFormatToDate(Input::get("enddate"));
		$userid = -1;
	
		$report = Sale::getDashboardSales($userid, $startdate, $enddate);
	
		return \Response::json($report);
	}
	
	/**
	 *
	 * @return
	 */
	public function getTopServices()
	{
		$startdate =  Util::changeStringFormatToDate(Input::get("startdate"));
		$enddate = Util::changeStringFormatToDate(Input::get("enddate"));
		
		
		return \Response::json(Service::getTopServices( $startdate, $enddate));
	}
	
	
	/**
	 *
	 * @return
	 */
	public function getTopUsers()
	{
		$startdate =  Util::changeStringFormatToDate(Input::get("startdate"));
		$enddate = Util::changeStringFormatToDate(Input::get("enddate"));
		
		
		return \Response::json(User::getTopUsers( $startdate, $enddate));
	}
	
	
	public function getPendingPayments()
	{
		$startDate = Util::getCurrentDate();
	
		$endDate = new Carbon();
		$endDate->startOfWeek()->format('d/m/Y');
	
	
		return \Response::json(Sale::getPendingPayments( $startDate, $endDate));
		
	}
	
	public function getTodaysFollowUp()
	{
		$startDate = Util::getCurrentDate();
	
		$endDate = new Carbon();
		$endDate->startOfWeek()->format('d/m/Y');
	
	
		return \Response::json(Sale::getPendingPayments( $startDate, $endDate));
	
	}
	
}
