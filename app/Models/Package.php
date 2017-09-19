<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends BaseModel   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't10_package';
	
	protected $primaryKey = 'a10_packageid';
	
	public $timestamps = false;
	
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];

	
	
	
	
	public static function getActive()
	{
		$packages = [''=>'Select package *'] + Service::where('a02_status', '=', 1)->
					where('a02_type', '=', 2)->orderBy('a02_name')->
					lists('a02_name', 'a02_id');
		return $packages;
	}
	
	
	public static function getAll()
	{
		return Service::orderBy('a02_name')->where('a02_type', '=', 2)->get();
	}
	
	public static function getById($id)
	{
		$package =  Service::with(['services'])->where('a02_id', '=', $id)->get()->first();
		return $package;
	}

}
