<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model   {

	
	//use SoftDeletes;

	protected $nullable = [];
		
	/**
	 * Listen for save event
	 */
	protected static function boot()
	{
		parent::boot();
	
		static::saving(function($model)
		{
			self::setNullables($model);
		});
	}
	
	/**
	 * Set empty nullable fields to null
	 * @param object $model
	 */
	protected static function setNullables($model)
	{
		foreach($model->nullable as $field)
		{
			if(empty($model->{$field}))
			{
				$model->{$field} = null;
			}
		}
	}
	

	
	
}
