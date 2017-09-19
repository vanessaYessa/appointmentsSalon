<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Util;

class ClientRequestForm extends FormRequest {

	//TODO: CHECK THAT IT DOESNT EXIST FOR THE COMPANY
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$attributes = parent::all();
		
		$rules = array(
				
				"id"		=>	"integer",
				"name"		=>	"required", 
				"mobile"	=>	"required|max:11|unique:t05_client,a05_mobile",
		);
		
		return $rules;
	}
	
	
	/**
	 * Sanitize input before validation.
	 *
	 * @return array
	 */
	public function all()
	{
		$attributes = parent::all();
		$attributes['mobile'] = Util::getPhoneNumber($attributes['mobile']);
		$this->replace($attributes);
		return $attributes;
	}
	
	
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
	
	public function messages()
	{
		return [
				'mobile.unique' => 'The mobile phone exist already'
		];
	}
	

}