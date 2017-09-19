<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends BaseModel   {

//	use SoftDeletes;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't16_payment';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['a16_id', 'a16_saleid', 'a16_amount', 'a16_date','a16_comment',
                            'a16_userid', 'a16_creationuser', 'a16_creationdate'
	];
	
	//ALTER TABLE `t06_appointment` ADD `a16_serviceid` INT NOT NULL AFTER `a16_userid`;
	

	public $timestamps = false;
	
	public $primaryKey = 'a16_id';
	
	
	/**
	 * Relationship with associate (2)
	 **/
	public function sale()
	{
		return $this->hasOne('App\Models\Sale', 'a07_id','a16_saleid');
	}
	
	public function user()
	{
		return  $this->hasOne("App\Models\User", 'a01_id',  'a16_userid');
	}
	
		
	public static function getBySaleId($saleId)
	{
		$appointments = Payment::where('a16_saleid', '=', $saleId)->
				orderBy('a16_date', 'asc');
		return $appointments->get();
	}
	
	
	//guarda pasto y guarda pa tu caballo
}
