<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends BaseModel   {

//	use SoftDeletes;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't15_inventory';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['a15_id', 'a15_name', 'a15_description', 'a15_modificationuser','a15_modificationdate',
                            'a15_quantity','a15_type', 'a15_status', 'a15_price', 'a15_brand',
							'a15_creationuser', 'a15_creationdate'
	];
	
	//ALTER TABLE `t06_appointment` ADD `a15_serviceid` INT NOT NULL AFTER `a15_userid`;
	

	public $timestamps = false;
	
	public $primaryKey = 'a15_id';
	
	
	/**
	 * Relationship with associate (2)
	 **/
	public function createdby()
	{
		return $this->hasOne('App\Models\User', 'a01_id','a15_creationuser');
	}
	
	
	public function updatedby()
	{
		return $this->hasOne('App\Models\User', 'a01_id','a15_modificationuser');
	}
	
		
	public static function getAll($roleId, $userId)
	{
		$appointments = Inventory::with("createdby", "updatedby")->
				orderBy('a15_name', 'asc');
		return $appointments->get();
	}
	
	public static function getExistence()
	{
		$appointments = ["" => "Select a product"] + Inventory::where('a15_quantity', '>', 0)
							->orderBy('a15_name', 'asc')
							->lists('a15_name', 'a15_id');
		return $appointments;
	}
	
	
	//guarda pasto y guarda pa tu caballo
}
