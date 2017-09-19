<?php 

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Reminder extends BaseModel   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't13_reminder';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['a13_id', 'a13_clientid', 'a13_userid', 'a13_serviceid',
                          'a13_date', 'a13_comments', 'a13_creationuser', 'a13_creationdate', 'a13_status'];
	
	public $timestamps = false;
	
	public $primaryKey = 'a13_id';
	
	
	
	public function client()
	{
		return $this->belongsTo('App\Models\Client', 'a13_clientid', 'a05_id');
	}
	
	public function client()
	{
		return $this->belongsTo('App\Models\Service', 'a13_serviceid', 'a02_id');
	}
	
	
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'a13_creationuser', 'a01_id');
	}
	
	public static function getByClientId($clientId)
	{
		$followups = FollowUp::with('service', 'service', 'user')->
						select(DB::raw("*, ".
								" DATE_FORMAT( a13_date, '%d') as day, ".
								" DATE_FORMAT( a13_date, '%M') as month "))->
						where('a13_clientid', '=', $clientId)->
						
						orderBy('a13_date', 'desc')->get(); //
		
		return $followups;
	}
	
	public static function getAll($filter)
	{
		$followups = FollowUp::with('contacttype')->
				leftjoin('t05_client', 'a05_id', '=', 'a13_clientid')->
				orderBy('a13_date', 'desc')->
				//orderBy('other_day_to_follow_up', 'desc')->
				get(); //
		return $followups;
	}
	
}
