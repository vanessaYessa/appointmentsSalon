<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowupFormRequest extends FormRequest {


	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		
		$rules = array(
						"clientid"	=>	"required|integer",
						"contactmethod"	=>	"required|integer",
						"comment"		=>	"required",
						"startdate"		=>	"required",
						"timefollow"	=>	"required"
					);
		
		return $rules;
	}

	/**
	 * Determine if the team is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
	
	
	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			//	'startdate.before' => 'The start date selected should be before today'
		];
	}

}