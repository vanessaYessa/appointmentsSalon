<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactType extends BaseModel   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't11_contacttype';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['a11_id',  'a11_description', 'a11_icon',  'a11_status'];

	public $timestamps = false;
	
	public $primaryKey = 'a11_id';
	
	
	public static function getAll()
	{
		$contactType = ContactType::orderBy('a11_description', 'asc')->get();
		return $contactType;
	}
	
	public static function getActive()
	{
		$contactType = ContactType::where("a11_status", "=", 1)
				->orderBy('a11_description', 'asc')
				->get()->lists('a11_description', 'a11_id');
		return $contactType;
	}
	
}
