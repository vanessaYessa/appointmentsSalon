<?php 

namespace App;




use Carbon\Carbon;

class Util  {

	/*
	|--------------------------------------------------------------------------
	| 
	|--------------------------------------------------------------------------
	|
	| This controller renders 
	| 
	| 
	|
	*/
	
	
	/**
	 * Display a listing of status.
	 *
	 * 
	 */
	public static function getStatus()
	{
		$status = [''=>'Select status', '1'=>'Active','0'=>'Inactive'];
		return $status;
	}
	
	
	/**
	 * Return a phone number value without format
	 * @param
	 * @return
	 */
	public static function removeEmpty($array)
	{
		unset($array[""]);
		return $array;
	}
	
	/**
	 *
	 * @param String format m/d/Y
	 * @return String date on format Y-m-d
	 */
	public static function changeStringFormatToDate($userFormat)
	{
		$arr = explode('/', $userFormat);
		$newDate = $arr[2].'-'.$arr[0].'-'.$arr[1];
		return $newDate;
	}
	

	/**
	 *
	 * @param String format h:m A
	 * @return String date on format Y-m-d
	 */
	public static function changeStringTime($meridiamTime)
	{
		$time = strtotime($meridiamTime);
		return date('H:i:s',$time);
	}
	
	/**
	 *
	 *
	 */
	public static function getCurrentTime()
	{
		date_default_timezone_set('America/New_York');
		return date('Y-m-d H:i:s T', time());
	}
	
	
	/**
	 * Return a phone number value without format
	 *
	 * @param $date object Format Y-m-d
	 * @return String date on format m/d/Y
	 */
	public static function getPhoneNumber($phoneNumberFormated)
	{
		if($phoneNumberFormated)
		{
			$valor = str_replace( array(" ", "(", ")", "-", "."), '', $phoneNumberFormated);
			return $valor;
		}
	}
	
	/**
	 *
	 *
	 */
	public static function getCurrentDate()
	{
		date_default_timezone_set('America/New_York');
		return date('Y-m-d', time());
	}
	
	public static function getStringFormat3($date)
	{
		if($date != null){
			$dt = Carbon::parse($date)->format('m/d/Y');
			return $dt;
		}
	}
	
	
	public static function getBOD($date)
	{
		if($date != null){
			$dt = Carbon::parse($date)->format('M, d');
			return $dt;
		}
	}
	
	
	/**
	 * Display a listing of status.
	 *
	 *
	 */
	public static function getInvoiceStatus()
	{
		$status = ['1'=>'Paid','2'=>'Pending'];
		return $status;
	}
	
	public static function getStringFormat2($date)
	{
		if($date != null){
			$dt = Carbon::parse($date)->format('M, d Y');
			return $dt;
		}
	}

	public static function getFollowUpInterval()
	{
		$status = [''=>'Select', '1'=>'days','2'=>'week','3'=>'months'];
		return $status;
	}
		
}
