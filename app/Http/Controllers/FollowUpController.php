<?php 

namespace App\Http\Controllers;

use App\Http\Requests\FollowupFormRequest;
use App\Models\ContactType;
use App\Models\FollowUp;
use App\Models\Prospect;
use App\Util;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\Client;


class FollowUpController extends VioclickController {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}
	
	/**
	 * Display a listing of the client.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contactType = ContactType::getActive();
		
		$filter = array();
		$followups = FollowUp::getAll( $filter);
		
		$data = array('contactType' => $contactType, 'followups' => $followups);
		
		return view('client.followup', $data);
	}
	
	
	public function store(FollowupFormRequest $request)
	{
		$followUp = new FollowUp;
		$followUp->a12_clientid = $request->clientid;
		$followUp->a12_contacttypeid = $request->contactmethod;
		$followUp->a12_comments = $request->comment;
		$followUp->a12_creationdate = Util::getCurrentTime();
		$followUp->a12_creationuser = 1; //$this->getId();
		
		$fullDate = $request->startdate . ' '.$request->timefollow;
		$contactDate =  Carbon::createFromFormat('m/d/Y h:i A', $fullDate)->toDateTimeString(); 
		$followUp->a12_date = $contactDate;
		$followUp->save();
	
		return (new ClientController)->edit($request->clientid); 
	}
	
	
	/**
	 * Modify comment
	 * @param FollowupFormRequest $request
	 */
	public function modifyComment()
	{
		$followUp = FollowUp::find(Input::get("id"));
		$followUp->a12_comments = Input::get("comments");
		$followUp->save();
		return \Response::json($followUp->save());
	}
 
	/**
	 * Remove the specified client from storage.
	 *
	 * @param  \App\Project $project
	 * @return Response
	 */
	public function destroy($id)
	{
		$followUp = Prospect::where('a103_id', '=', $id);
	    $followUp->delete(); 
	
	   return redirect('client');
	}
	
}
