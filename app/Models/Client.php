<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Client extends BaseModel {

	
	use SoftDeletes;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't05_client';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['a05_id', 'a05_name', 'a05_lastname', 'a05_mobile', 'a05_dob', 'a05_gender',
							'a05_phone', 'a05_email','a05_calleverynumber', 'a05_calleveryperiod', 'a05_comments',
							'a05_status', 'deleted_at', 'a05_belongsto'
	];
	
	
	protected $nullable =  [ 'a05_lastname', 'a05_mobile', 'a05_calleverynumber', 'a05_calleveryperiod', 'a05_comments',
							 'a05_gender', 'a05_email', 'deleted_at', 'a05_belongsto'];
	
	public $timestamps = false;
	
	public $primaryKey = 'a05_id';
	
	
	
	public function belongTo()
	{
		return $this->hasOne('App\Models\User', 'a102_id', 'a05_belongsto');
	}
	
	
	public static function getAll($roleId, $userId, $filter)
	{
		$query = Client::orderBy('a05_name');
	
		foreach ($filter as $where)
		{
			/*if($where[0] == "a117_creationdate")
				$query-> whereDate($where[0], $where[1] ,$where[2]);
			else
			{
				if($where[1] == "IN")
					$query-> whereIn($where[0], $where[2]);
				else
					
			}	*/
			if($where[1] == "LIKE")
				$query->whereRaw( 'UPPER ('.$where[0]. ') like UPPER("%'.$where[2]. '%")');
			else 
				$query-> where($where[0], $where[1] ,$where[2]);
		}	
		
		return $query->get();
	}

	public static function getById($id)
	{
		$client =  Client::with([ 'createdBy' ])->
					where('a05_id', '=', $id)->
					get()->first();
	
		return $client;
	}
	
	public static function getLastDetails($id)
	{
		$client = DB::select ( DB::raw ( "SELECT DATE_FORMAT( a06_startdate, '%Y-%m-%d') as start_date, 
				a09_name as status_app 
				FROM t06_appointment INNER JOIN t09_appointment_status ON (a09_id = a06_status)
				Where a06_clientid = $id HAVing max(A06_startdate)") );
		
		if($client)
		{
			$client['services'] = DB::select ( DB::raw ( "SELECT a02_name
					FROM t07_sales
					INNER JOIN t08_sale_detail ON (  `a08_saleid` = a07_id )
					INNER JOIN t02_service ON ( a02_id =  `a08_serviceid` )
					WHERE a07_clientid = $id
					AND a08_saleid = (
					SELECT a07_id
					FROM t07_sales WHERE a07_clientid = $id
					order by a07_date desc limit 0,1) ") );
			
		}
		
	
		return $client;
	}
	
}
