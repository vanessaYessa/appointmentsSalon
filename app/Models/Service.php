<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Service extends BaseModel   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't02_service';
	
	protected $primaryKey = 'a02_id';
	
	public $timestamps = false;
	
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['a02_id', 'a02_name', 'a02_type', 'a02_remindevery', 'a02_remindeveryperiod', 'a02_image',
							'a02_description','a02_duration', 'a02_durationscale',  'a02_price',  'a02_status'];
	
	public $maps = ['a02_name' => 'name', 'a02_duration' => 'duration'];
	
	
	//THEY SHOULD HAVE THEIR GET 
	protected $appends = [
			'durationscale'
	];
	
	public function services()
	{
		return  $this->belongsToMany("App\Models\Service", 't10_package', 'a10_packageid', 'a10_serviceid');
	
	}
	
	public function getDurationScaleAttribute()
	{
		if($this->attributes['a02_durationscale'] == null) 
			return "";		
		elseif($this->attributes['a02_durationscale'] == 1) 
			return "minutes"; 
		else "hours";
	}
	
	
	
	public static function getActive()
	{
		        $services = [''=>'Select service *'] + 
		        	Service::where('a02_status', '=', 1)->
		        	orderBy('a02_name')->
					lists('a02_name', 'a02_id');
		        
		return $services;
	}
	
	
	public static function getActiveServices()
	{
		$services = [''=>'Select service *'] + Service::
					where('a02_status', '=', 1)->orderBy('a02_name')->
					lists('a02_name', 'a02_id');
		return $services;
	}
	
	
	
	public function user()
	{
		return  $this->belongsToMany("App\Models\User", 'a03_serviceid', 'a03_userid');
	}
	
	//Get only services
	public static function getAll()
	{
		return Service::where('a02_type', '=', 1)->orderBy('a02_name')->get();
	}
	
	public static function getAllActive()
	{
		return Service::where('a02_type', '=', 1)->
		        		where('a02_status', '=', 1)->orderBy('a02_name')->get();
	}
	
	public static function getById($id) 
	{
		$service =  Service::with(['services'])->
						where('a02_id', '=', $id)->get()->first();
		return $service;
	}
	
	public static function getPackageById($id)
	{
		$package =  Service::with(['services'])->
				where('a02_id', '=', $id)->get()->first();
		return $package;
	}
	
	public static function getTopServices($fromdate, $enddate)
	{
		$appointment = DB::select (DB::raw("SELECT a02_name as service, count(a02_id) as cont 
							FROM t08_sale_detail inner join t02_service on ( a02_id = a08_serviceid)
							inner join t07_sales on ( a07_id = a08_saleid)
							WHERE a07_date between '$fromdate' and '$enddate' and a07_status = 1
							group by a02_id "));
		return $appointment;
	}
}
