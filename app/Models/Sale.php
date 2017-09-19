<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Sale extends BaseModel {

	
	use SoftDeletes;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't07_sales';
	      
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['a07_id', 'a07_date', 'a07_clientid', 'a07_creationuser', 
							'a07_creationdate', 'a07_totalvalue','a07_tip',
                           	'a07_status', 'a07_comment', 'deleted_at'
	];	
	
	protected $nullable =  [ 'deleted_at'];
	
	public $timestamps = false;
	
	public $primaryKey = 'a07_id';
	
	
	public function createdby()
	{
		return $this->hasOne('App\Models\User','a01_id', 'a07_creationuser');
	}
	
	public function client()
	{
		return  $this->hasOne("App\Models\Client", 'a05_id',  'a07_clientid');
	}
	
	
	public function details()
	{
		return  $this->hasMany("App\Models\SaleDetail", 'a08_saleid',  'a07_id');
	}
	
	public function payments()
	{
		return  $this->hasMany("App\Models\Payment", 'a16_saleid',  'a07_id');
	}
	
	
	public static function getAll($roleId, $userId, $filter)
	{
		$query = Sale::with(['createdby', 'client'  ]);
	
		foreach ($filter as $where)
		{
			if($where[0] == "a07_creationuser")
				$query-> whereDate($where[0], $where[1] ,$where[2]);
			else
			{
				if($where[1] == "IN")
					$query-> whereIn($where[0], $where[2]);
				else
					$query-> where($where[0], $where[1] ,$where[2]);
			}	
		}	
		
		$query->orderBy('a07_creationdate', 'desc');
		
		return $query->get();
	}

	public static function getById($id)
	{
		$sales =  Sale::with([ 'createdby', 'details', 'details.service', 
								'details.inventory', 'client', 'payments', 
								'payments.user' ])->
						where('a07_id', '=', $id)->
						get()->first(); 
		
		return $sales;
	}
	
	public static function getByClientId($clientId)
	{
		$sales = Sale::where('a07_clientid', '=', $clientId)->
			orderBy('a07_creationdate', 'desc')->get(); //
	
		return $sales;
	}
	
	
	public static function getDashboardSales($userid, $startdate, $enddate)
	{
		$query = Sale::select(DB::raw("DATE_FORMAT( a07_date, '%M-%d') as date, sum(a07_totalvalue - a07_tip) as value"))->
					with(['createdby' ]);
	
		$query-> whereDate("a07_date", ">=" ,$startdate);
		$query-> whereDate("a07_date", "<=" ,$enddate);
		
		/* foreach ($filter as $where)
		{
			if($where[0] == "a07_date")
				
			else
			{
				if($where[1] == "IN")
					$query-> whereIn($where[0], $where[2]);
				else
					$query-> where($where[0], $where[1] ,$where[2]);
			}
		} */
	
		$query->groupBy('a07_date');
		$query->orderBy('a07_date', 'asc');
	
		return $query->get();
	}
	
	
	public static function getPendingPayments($fromDate, $endDate) //$roleId, $userId, 
	{
		
		$query = Sale::with(['client'])->
					select(DB::raw("*, ( select ( a07_totalvalue - IFNULL(sum(a16_amount), 0) ) 
							from t16_payment where a16_saleid = a07_id ) as pending "))->
					where("a07_status", "=" , 2)->
					groupBy('a07_id');
		return $query->get();
	}
	
}
