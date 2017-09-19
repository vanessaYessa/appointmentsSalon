<?php namespace App\Exceptions;

use Exception;


class EloquentException extends Exception {

	
	//Constrain names with their related message
	private static $fk_registred = array (
			
			//
			"t08_sale_detail_ibfk_5" => "The user has sales associated",
			
	);
	
	
	public static function getFKError($e)
	{
		//Get error string and split it
		$array1 = explode ( "CONSTRAINT " , $e->errorInfo[2]  );
		
		//Get constraint name that caused the error
		$result = preg_match_all('"([^\\`]+)"', $array1[1], $result );
		preg_match_all('"([^\\`]+)"', $array1[1], $result );
		
		$response = self::$fk_registred[$result[0][0]];
		
		if( strlen($response ) == 0)
			$response = "it has elements associated";
		//Return custom message to user
		return $response;
	}
	
	
}
