<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appointment extends BaseModel   {

//	use SoftDeletes;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't06_appointment';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['a06_id', 'a06_clientid', 'a06_startdate', 'a06_modificationuser','a06_modificationdate',
                            'a06_enddate','a06_description', 'a06_userid', 'a06_comments',
							'a06_status','a06_creationuser', 'a06_creationdate', 'deleted_at',
							'a06_commentsresult', 'a06_serviceid',
	];
	
	//ALTER TABLE `t06_appointment` ADD `a06_serviceid` INT NOT NULL AFTER `a06_userid`;
	

	public $timestamps = false;
	
	public $primaryKey = 'a06_id';
	
	
	/**
	 * Relationship with associate (2)
	 **/
	public function createdby()
	{
		return $this->hasOne('App\Models\User', 'a01_id','a06_creationuser');
	}
	
	
	public function updatetedby()
	{
		return $this->hasOne('App\Models\User', 'a01_id','a06_modificationuser');
	}
	
	/**
	 * Relationship with associate (2)
	 **/
	public function client()
	{
		return $this->hasOne('App\Models\Client', 'a05_id', 'a06_clientid');
	}
	
	/**
	 * Relationship with status
	 */
	public function status()
	{
		return $this->belongsTo('App\Models\AppointmentStatus', 'a06_status',  'a09_id');
	}
	
	
	public function service()
	{
		return $this->hasOne('App\Models\Service',  'a02_id','a06_serviceid');
	}
	
	public function user()
	{
		return $this->hasOne('App\Models\User', 'a01_id','a06_userid');
	}
	
	
	
	public static function getByCompany($roleId, $startDate, $endDate, $userId)
	{
		$appointments = Appointment::select(DB::raw("a06_clientid as id, ".
				" concat(DATE_FORMAT( a06_startdate, '%Y-%m-%d'), ' ', a06_starttime) as start, ".
				" concat(DATE_FORMAT( a06_enddate, '%Y-%m-%d'), ' ', a06_endtime) as end, ".
				" a06_description as title, 'black' as borderColor, ".
				" a01_username as username , ".
				" a01_calendarcolor as backgroundColor"))->
				//" (case when a06_status = 1 then a01_calendarcolor else a09_color end ) as backgroundColor"))->
				join('t09_appointment_status', 'a09_id', '=', 'a06_status')->
				join('t01_user', 'a01_id', '=', 'a06_userid')->
				whereDate("a06_startdate", ">=" ,$startDate)->
				whereDate("a06_enddate", "<=" ,$endDate)->
				groupBy('a06_clientid')->
				groupBy('a06_startdate')->
				groupBy('a06_userid')->
				groupBy('a06_serviceid')->
				orderBy('a06_starttime', 'asc');
		
		return $appointments->get();
	}
	
	public static function getByUser($roleId, $startDate, $endDate, $userId)
	{
		$appointments = Appointment::select(DB::raw("a06_clientid as id, ".
				" concat(DATE_FORMAT( a06_startdate, '%Y-%m-%d'), ' ', a06_starttime) as start, ".
				" concat(DATE_FORMAT( a06_enddate, '%Y-%m-%d'), ' ', a06_endtime) as end, ".
				" a06_description as title, 'black' as borderColor, ".
				" a09_color as backgroundColor, ".
				" a01_username as username"))->
				join('t01_user', 'a01_id', '=', 'a06_userid')->
				join('t09_appointment_status', 'a09_id', '=', 'a06_status')->
				where("a06_userid", "=" ,$userId)->
				whereDate("a06_startdate", ">=" ,$startDate)->
				whereDate("a06_enddate", "<=" ,$endDate)->
				groupBy('a06_clientid')->
				groupBy('a06_creationdate')->
				orderBy('a06_starttime', 'asc'); 
		return $appointments->get();
	}
	//guarda pasto y guarda pa tu caballo
	
	public static function getByClient($clientId, $date)
	{
		
		if($clientId > 0 )
		{
			$appointments = Appointment::with(['client','createdby','service','user'])->
			select(DB::raw("*, ".
					" DATE_FORMAT( a06_startdate, '%m/%d/%Y') as start, ".
					" DATE_FORMAT( a06_enddate, '%m/%d/%Y') as end, ".
					" DATE_FORMAT( a06_starttime, '%h:%i %p') as timestart, ".
					" DATE_FORMAT( a06_creationdate, '%m/%d/%Y %h:%i %p') as creation, ".
					" DATE_FORMAT( a06_endtime, '%h:%i %p') as timeend "))->
					whereDate("a06_startdate", "=" ,$date)->
					where("a06_clientid", "=" ,$clientId)->
			orderBy('a06_starttime', 'asc')->get();
		}
		else 
		{
			$appointments = Appointment::with(['client','createdby','service','user'])->
			select(DB::raw("*, ".
					" DATE_FORMAT( a06_starttime, '%h:%i %p') as timestart2, ".
					" TIMEDIFF(a06_endtime, a06_starttime) as duration, ".
					" DATE_FORMAT( a06_endtime, '%h:%i %p') as timeend "))->
					whereDate("a06_startdate", "=" ,$date)->
					orderBy('a06_starttime', 'asc')->get();
		}
		return $appointments;
	}
	
	public static function getById($id)
	{
		$appointment = Appointment::with(['client','createdby', 'service'])->
			select(DB::raw("*, ".
					" DATE_FORMAT( a06_startdate, '%m/%d/%Y') as start, ".
					" DATE_FORMAT( a06_enddate, '%m/%d/%Y') as end, ".
					" DATE_FORMAT( a06_starttime, '%h:%i %p') as timestart, ".
					" DATE_FORMAT( a06_creationdate, '%m/%d/%Y %h:%i %p') as creation, ".
					" DATE_FORMAT( a06_endtime, '%h:%i %p') as timeend "))->
			where("a06_id", "=", $id)->get();
						
		return $appointment;
	}
	
	
	public static function getAppointmentSales($userid, $startdate, $enddate)
	{
		$appointment =  DB::select ( DB::raw ("SELECT a09_color as color, 
							DATE_FORMAT( a06_startdate, '%M, %d') as fecha , 
							a09_name as status, count(a06_id) count 
						FROM t06_appointment inner join t09_appointment_status on (a09_id = a06_status) 
						WHERE DATE_FORMAT( a06_startdate, '%Y-%m-%d') between '2017-03-01' and '2017-03-29' 
						group by a06_startdate, a06_status order by a06_startdate asc, color asc "));//'$startdate' and  '$enddate'
		if($userid > 0)
			where("a07_clientid", "=", $userid)->get();
	
		return $appointment;
	}
}
