<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends BaseModel   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 't09_appointment_status';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['a09_id',  'a09_name', 
                          'a09_class','a09_color', 'a09_status'];

	public $timestamps = false;
	
	public $primaryKey = 'a09_id';
	
	
	public static function getAll()
	{
		$appointmentStatus = AppointmentStatus::orderBy('a09_id', 'asc')->get();
		return $appointmentStatus;
	}
	
	public static function getActive()
	{
		$appointmentStatus = AppointmentStatus::where("a09_status", "=", 1)
				->orderBy('a09_id', 'asc')
				->get()->lists('a09_name', 'a09_id');
		return $appointmentStatus;
	}
	
	public static function getAllActive()
	{
		$appointmentStatus = AppointmentStatus::where("a09_status", "=", 1)
				->orderBy('a09_id', 'asc')->get();
		return $appointmentStatus;
	}
}
