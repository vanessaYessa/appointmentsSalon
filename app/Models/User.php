<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model implements AuthenticatableContract {

	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't01_user';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['a01_id', 'a01_name', 'a01_lastname', 'a01_username', 'a01_image', 'a01_showcalendar',
				'a01_phone', 'a01_calendarcolor', 'a01_roleid', 'a01_password', 'a01_status'];

	public $primaryKey = 'a01_id';
	
	public $timestamps = false;
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = ['a01_password'];
	
	public function user()
	{
		return  $this->belongsTo("App\Models\SaleDetail");
	}


	public static function getUser($userName)
	{
		return User::where('a01_username', '=', $email)->get()->first();
	}
	
	public static function getActive()
	{
		$users =  [''=>'Select user']; 
		
		return $users += User::where('a01_status', '=', 1)->get()->lists('a01_username', 'a01_id');
	}
	
	public static function getAllActive()
	{
		return User::where('a01_status', '=', 1)->get();
	}
	
	
	public static function getTopUsers($fromdate, $enddate)
	{
		$appointment = DB::select (DB::raw("SELECT a01_username as user, count(a01_id) as cont
				FROM t08_sale_detail inner join t01_user on ( a01_id = a08_userid)
				inner join t07_sales on ( a07_id = a08_saleid) 
				WHERE a07_date between '$fromdate' and '$enddate' and a07_status = 1
				group by a01_id "));
		return $appointment;
	}
}
