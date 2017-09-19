<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends BaseModel   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't08_sale_detail';
	
	protected $primaryKey = 'a08_id';
	
	public $timestamps = false;
	
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['a08_id', 'a08_saleid', 'a08_serviceid', 'a08_inventoryid', 
				'a08_price', 'a08_quantity', 'a08_userid'];

	public function sale()
	{
		return $this->hasMany('App\Models\Sale', 'a08_saleid', 'a07_id');
	}
	
	
	public function service()
	{
		return  $this->hasMany("App\Models\Service", 'a02_id', 'a08_serviceid');
	}
	
	public function user()
	{
		return  $this->hasMany("App\Models\User", 'a01_id', 'a08_userid');
	}
	
	public function inventory()
	{
		return  $this->hasMany("App\Models\Inventory", 'a15_id', 'a08_inventoryid');
	}
	
}
