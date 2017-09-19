<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebFormRequest extends FormRequest {


	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{	
		$rules = array(
						"name"			=>	"required|min:3|max:50",
						"lastname"		=>	"required|min:3|max:50",
						//"email" 		=>  "required|email|unique:t100_company,a100_email|unique:t102_associate,a102_email|unique:t104_user,a104_email",
						//"companyname"	=>	"required|min:5|max:50",
						//"country"		=>	"required|integer",
						//"state"			=>	"required|integer",
						//"users"			=>	"required|integer",
						"password" 		=> 	"required|between:6,15",
						"password2"		=> 	"same:password|required|between:6,15",
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
	
	
	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
				'companyname.required' => 'The company name is required.',
				'password2.required' => 'The confirm password is required.',
				'email.unique' => 'The email already exist in our system. Try another or login.'
		];
	}

}