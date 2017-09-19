<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentFormRequest extends FormRequest {

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
				
				"appointmentid"	=>	"integer",
				"clientid"	=>	"required|integer",
				"startdate"		=>	"required|min:10|max:10",
				"time"			=>	"required|min:8|max:8",
				"timeend"		=>	"required|min:8|max:8",
				"comments"		=>	"required",				
				"userid"		=>	"integer|required"
				
		);
		
		return $rules;
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
	

}