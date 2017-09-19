<?php 

namespace App\Models;


use Illuminate\Support\Facades\DB;

class FollowUp extends BaseModel   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't12_follow_up';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['a12_id', 'a12_clientid', 'a12_contacttypeid', 
                          'a12_date', 'a12_comments', 'a12_creationuser', 'a12_creationdate'];
	
	public $timestamps = false;
	
	public $primaryKey = 'a12_id';
	
	
	
	public function client()
	{
		return $this->belongsTo('App\Models\Client', 'a12_clientid', 'a05_id');
	}
		
	
	public function contacttype()
	{
		return $this->belongsTo('App\Models\ContactType', 'a12_contacttypeid', 'a11_id');
	}
	
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'a12_creationuser', 'a01_id');
	}
	
	public static function getByClientId($clientId)
	{
		$followups = FollowUp::with('contacttype', 'user')->
						select(DB::raw("*, ".
								" DATE_FORMAT( a12_date, '%d') as day, ".
								" DATE_FORMAT( a12_date, '%M') as month "))->
						where('a12_clientid', '=', $clientId)->
						
						orderBy('a12_date', 'desc')->get(); //
		
		return $followups;
	}
	
	public static function getAll($filter)
	{
		$followups = FollowUp::with('contacttype')->
				leftjoin('t05_client', 'a05_id', '=', 'a12_clientid')->
				orderBy('a12_date', 'desc')->
				//orderBy('other_day_to_follow_up', 'desc')->
				get(); //
		return $followups;
	}
	
}
