
@extends('layouts.master')

@section('content')
    
    <h3 class="blank1">Pre Qualification Form</h3>
    
    <h3 class="blank1" style="float: right;">Deal Center</h3>
        
        @if($errors->all())
		    <p class="alert alert-danger">
	        	@foreach($errors->all() as $error)
	                {{$error}}<br/>
	            @endforeach
	        </p>
		@endif
		
		<style>
			.table>tbody>tr>td{
				padding: 2px 8px 0px 8px !important;
				font-weight: normal;
			}
			.form-control
			{
				height: 32px;
				padding: 6px 6px;
				font-size: 12px;
			}
			.td {
			    font-size: 20px ;
			}
			.table .table {
				background-color: transparent; 
			}
			
		</style>
		
		
		 {!! Form::open(array('action' => 'QualificationController@update', 'class' => 'form-horizontal')) !!}
		 	{!! Form::hidden('id', $qualification->a119_id) !!}
             <table class="table  table-bordered " style="width: 60%" >
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
			             		<td >Member *</td>
			             		<td >Assign to</td>
			             		<td >Status *</td>
			             		<td><b>Created by</b></td>
			             		<td><b>Creation date</b></td>
			             	</tr>
			             	<tr>
			            		<td > {!! Form::select('associateid', $associates, $qualification->associate->a102_id, ['class'=> 'form-control', 'style' =>'width: 120px;' ])!!}</td>
			            		<td > {!! Form::select('assignto', $associates, $qualification->a119_assignto, ['class'=> 'form-control', 'style' =>'width: 120px;' ])!!}</td>
			            		<td > {!! Form::select('status', App\Util::getQualificationStatus(), $qualification->a119_status, ['class'=> 'form-control', 'style' =>'width: 120px;' ])!!}</td>
			            		<td>{!! $qualification->createdBy->a102_username!!} </td>
								<td>{!! App\Util::getStringFormat2($qualification->a119_creationdate)!!}</td>
			             	</tr>
             			</table>
             		</th>
             	</tr>
             	             	
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
				             	<th colspan="4" ><h4>Type of Mortage and purpose of Loan</h4></th>
			             	</tr>
			             	<tr> 
			             	    <td width="200px">Applied for*</td>
			             	    <td>Loan Purpose *</td>
			             		<td>Specify other loan purpose</td>
			                </tr>
				            <tr>
				                <td>{!!Form::select('appliedfor', $appliedFor, $qualification->appliedFor->a021_id, ['id' => 'my-select',  'onChange' => 'otherAppliedF(this.value);', 'class'=> 'form-control'])!!}</td>
				                <td>{!!Form::select('loanpurpose', $loanPurpose, $qualification->loanPurspose->a021_id, ['id' => 'loanPurpose', 'onChange' => 'otherPurposeF(this.value);', 'class'=> 'form-control'])!!}</td>
			             		<td>{!! Form::text('otherpurpose', $qualification->a119_loanpurposeother,  ['class'=> 'form-control', 'id' => 'otherPurpose', 'readonly' => 'true']) !!}</td>
			                </tr>
			                 <tr>
						 		<td>Property use *</td>
			                	<td>Units number</td>
						    </tr>
			             	<tr>
			             		<td>{!!Form::select('propertyuse', $propertyUse, $qualification->propertyUse->a021_id, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
			             		<td>{!! Form::text('unitsnumber', $qualification->a119_unitsnumber,  ['class'=> 'form-control']) !!}</td>
			             	</tr>
			             	<tr>
             			</table>
             		</th>
             	</tr>
             	
             	<tr>
             		<td colspan="4">
             			<table class="table">
             				<tr>
					        	<th colspan="4"><h4>Property information</h4></th>
			             	</tr>
			             	<tr>
			             		<td>Country *</td>
			             		<td>State *</td>
			             		<td>City *</td>
			             	</tr>
			             	<tr>
			             		<td>{!!Form::select('country',  $country, $qualification->state->a002_countryid, ['id' =>
											'country', 'class'=> 'form-control', 'onchange' => 'getStates(this.value)'])!!}
								</td>
			             		<td>{!!Form::select('state', ["" => 'Select state'], $qualification->a119_stateid, ['id' => 'state', 'class'=> 'form-control', 'onchange' => 'getCities(this.value)']) !!}</td>
			             		<td>{!!Form::select('city', ["" => "Select city"], $qualification->a119_cityid, ['id' => 'city', 'class'=> 'form-control']) !!}</td>
			             	</tr>
			             	
			             	<tr>
			             		<td colspan="3">Address*</td>
			             		<td>ZipCode*</td>
			             	</tr>
			             	
			             	<tr>
			             		<td colspan="3"> {!! Form::text('address', $qualification->a119_address,  ['class'=> 'form-control']) !!}<br/></td>
			             		<td>{!! Form::text('zipcode', $qualification->a119_zipcode,  ['class'=> 'form-control', 'id' => 'zipcode']) !!}</td>
			             	</tr>
             			</table>
             		</td>
             	</tr>
             	
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
				             	<th colspan="4" ><h4>Borrower Information</h4></th>
			             	</tr>
			             	<tr>
			             		<td width="120px" >Name *</td>
					            <td width="200px">Lastname *</td>
					            <td width="150px">Mobile *</td>
					            <td width="150px">SSN</td>
				            </tr>
				            <tr>
			             		<td width="25%">{!! Form::text('name', $qualification->borrower->a117_name,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('lastname', $qualification->borrower->a117_lastname, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('mobile', $qualification->borrower->a117_mobile,  ['class'=> 'form-control', 'id' => 'mobile']) !!}</td>
             					<td>{!! Form::text('ssn', $qualification->borrower->a117_ssn,  ['class'=> 'form-control', 'id' => 'ssn']) !!}</td>
			             	</tr>
			             	<tr>
			             		<td width="180px">Date of Birth</td>
					            <td>Civil Status </td>
					            <td >Email</td>
					            
				            </tr>
				            <tr>
			             		<td>{!! Form::text('dob', App\Util::getStringFormat3($qualification->borrower->a117_dob),  ['class'=> 'form-control', 'id' => 'dob']) !!}</td>
             					<td >{!!Form::select('civilstatus', App\Util::getCivilStatus(), $qualification->borrower->a117_civilstatus, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
             				    <td colspan="2">{!! Form::text('email', $qualification->borrower->a117_email,  ['class'=> 'form-control', 'id' => 'email']) !!}</td>
					     	</tr>
			             	
			             	<tr>
				             	<th colspan="4" align="center"><br/><h5>Address Information</h5></th>
			             	</tr>
			             	<tr>
			             		<td>Country</td>
			             		<td>State</td>
			             		<td>City</td>
			             		<td>ZipCode</td>
			             	</tr>
			             	<tr>
			             		<td>{!!Form::select('countryb',  $country, $qualification->borrower->state->a002_countryid, ['id' =>
									'countryb', 'class'=> 'form-control', 'onchange' =>
									"getStates(this.value, 0, 'stateb' )"])!!}</td>
			             		<td>{!!Form::select('stateb', ["" => 'Select state'], null, ['id' => 'stateb', 'class'=> 'form-control', 'onchange' => "getCities(this.value, 0, 'cityb')"]) !!}</td>
			             		<td>{!!Form::select('cityb', ["" => "Select city"], null, ['id' => 'cityb', 'class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('zipcodeb', $qualification->borrower->a117_zipcode,  ['class'=> 'form-control', 'id' => 'zipcode']) !!}</td>
			             	</tr>
			             	
			             	<tr>
			             		<td>Address</td>
			             		<td>Pity / Rent</td>
			             		<td >Housing situation</td>
			             		<td >Months living here </td>
			             	</tr>
			             	
			             	<tr>
			             		<td> {!! Form::text('addressb', $qualification->borrower->a117_address,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('rentb', $qualification->borrower->a117_pity,  ['class'=> 'form-control', 'id' => 'rentb']) !!}</td>
			             		<td>
			             			{!!Form::radio('housing', 'Own', ( ($qualification->borrower->a117_typehouse == 'Own') ? 1 : 0), ['class'=> ''])!!} Own &nbsp;&nbsp;&nbsp;
									{!!Form::radio('housing', 'Rent', ( ($qualification->borrower->a117_typehouse == 'Rent') ? 1 : 0),  ['class'=> ''])!!} Rent</label>					
								</td>
			             		<td>{!!Form::selectRange('timeoflivingb', 0, 30,  $qualification->borrower->a117_livingtime, ['class'=> 'form-control', 'id' => 'my-select', 'onchange' => "showOtherAddress(this.value, 'bSecondAddress');"])!!}</td>
			             	</tr>
			             	
			             	<tr id="bSecondAddress" style="display: none">
			             		<td colspan="4">Previous address:  {!! Form::text('addressbprevious', $qualification->borrower->a117_previousaddress,  ['class'=> 'form-control', ]) !!}<br/></td>
			             	</tr>
			             	
			             	
			             	<tr>
				             	<th colspan="4" align="center"><br/><h5>Employee Information</h5></th>
			             	</tr>
			             	<tr>			             		
			             		<td width="120px" >Self Employed</td>
			             		<td width="120px" >Employer *</td>
					            <td width="200px">Position *</td>
					            <td width="150px">Phone  *</td>
					            
				            </tr>
				            <tr>
			             		<td>{!! Form::checkbox('selfemployee', 1, $qualification->borrower->a117_selfemployee, ['class'=> 'checkbox1', 'style'=> 'font-size: 10px;']) !!}</td>
			             		<td width="25%">{!! Form::text('employerb', $qualification->borrower->a117_employername,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('positionb', $qualification->borrower->a117_employeeposition, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('phoneb', $qualification->borrower->a117_employeephone,  ['class'=> 'form-control', 'id' => 'phoneb']) !!}</td>
			             	</tr>
			             	
			             	<tr>
			             		<td >Basic salary *</td>
			             		<td width="200px">Oher compensation</td>
					           	<td width="150px">Oher Compensation type </td>
					           	<td width="120px" >Months in this job *</td>
					       </tr>
				           
				            <tr>
			             		<td>{!! Form::text('salaryb', $qualification->borrower->a117_employeebasicsalary,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('compensationb', $qualification->borrower->a117_employeeothercompansation, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::select('compensationtype1b', App\Util::getCompensationType(),  $qualification->borrower->a117_employeeothercompansantiontype, ['class'=> 'form-control']) !!}</td>
             					<td width="25%">{!! Form::selectRange('timejobb', 0, 30,  $qualification->borrower->a117_employeeduration, ['class'=> 'form-control', 'id' => 'my-select', 'onchange' => "showOtherAddress(this.value, 'bSecondJob');"])!!}</td>
			             	</tr>
			             	 
				            <tr id="bSecondJob" style="display: none">
			             		<td colspan="4">Previous job:  {!! Form::text('previousjobb', $qualification->borrower->a117_employeebefore,  ['class'=> 'form-control']) !!}<br/></td>
			             	</tr>
			             	
			             	<tr>
			             		<th colspan="4" align="center"><br/><h5>Employment Address</h5></th>
			             	</tr>
			             	<tr>
			             		<td>Country</td>
			             		<td>State</td>
			             		<td>City</td>
			             	</tr>
			             	<tr>
			             		<td>{!!Form::select('countryjobb',  $country, 1, ['id' =>
									'countryjob', 'class'=> 'form-control', 'onchange' =>
									"getStates(this.value, 0, 'statejob')"])!!}</td> 
			             		<td>{!!Form::select('statejobb', ["" => 'Select state'], null, ['id' => 'statejob', 'class'=> 'form-control', 'onchange' => "getCities(this.value, 0, 'cityjobb')"]) !!}</td>
			             		<td>{!!Form::select('cityjobb', ["" => "Select city"], null, ['id' => 'cityjobb', 'class'=> 'form-control']) !!}</td>
			             		
			             	</tr>
			             	<tr>
			             		<td colspan="2">Address</td>
			             		<td >ZipCode</td>
			             		
			             	</tr>
			             	<tr>
				             	<td colspan="2"> {!! Form::text('addressjobb', $qualification->borrower->a117_employeeaddress,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('zipcodejob', $qualification->borrower->a117_employeezipcode,  ['class'=> 'form-control', 'id' => 'zipcode']) !!}</td>
				             </tr>
             			</table>
             		</th>
             	</tr>
             	
             	<tr>
             		<th colspan="4">
             			<div style="float: right;"> {!! Form::checkbox('coborrower', 1, null, ['class'=> 'checkbox1', 'style'=> 'font-size: 10px;', 'onclick'=> 'showCoborrower(this);']) !!} Add Coborrower</div>
             			<table class="" >
             				 <tr>
				             	<th colspan="2"><h4>Coborrower Information</h4></th>
			             	</tr>
			             	
             			</table>
             			
             			<?php 
             				//if($qualification->coborrower)
	             			$name = (($qualification->coborrower) ? $qualification->coborrower->a117_name : NULL);
	             			$dob = (($qualification->coborrower) ? App\Util::getStringFormat3($qualification->coborrower->a117_dob) : NULL);;
	             			$civilstatus = (($qualification->coborrower) ? $qualification->coborrower->a117_civilstatus : NULL);
	             			$lastname = (($qualification->coborrower) ? $qualification->coborrower->a117_lastname : NULL);
	             			$mobile = (($qualification->coborrower) ? $qualification->coborrower->a117_mobile : NULL);
	             			$ssn = (($qualification->coborrower) ? $qualification->coborrower->a117_ssn : NULL);
             			
	             			$civilstatus = (($qualification->coborrower) ? $qualification->coborrower->a117_civilstatus : NULL);
	             			$email = (($qualification->coborrower) ? $qualification->coborrower->a117_email : NULL);
	             			$address = (($qualification->coborrower) ? $qualification->coborrower->a117_address : NULL);
	             			$zipCodeJob = (($qualification->coborrower) ? $qualification->coborrower->a117_zipcode : NULL);
             			
	             			$pity = (($qualification->coborrower) ? $qualification->coborrower->a117_pity : NULL);
	             			$typehouse = (($qualification->coborrower) ? $qualification->coborrower->a117_typehouse : NULL);
	             			$livingtime = (($qualification->coborrower) ? $qualification->borrower->a117_livingtime : NULL);
	             			$previousaddress = (($qualification->coborrower) ? $qualification->borrower->a117_previousaddress : NULL);
	             			
	             			$selfEmployed = (($qualification->coborrower) ? $qualification->coborrower->a117_selfemployee : NULL);
	             			$employer = (($qualification->coborrower) ? $qualification->coborrower->a117_employername : NULL);
	             			$position = (($qualification->coborrower) ? $qualification->borrower->a117_employeeposition : NULL);
	             			$phone = (($qualification->coborrower) ? $qualification->borrower->a117_employeephone : NULL);
	             			$salary = (($qualification->coborrower) ? $qualification->coborrower->a117_employeebasicsalary : NULL);
	             			$otherCompensation = (($qualification->coborrower) ? $qualification->coborrower->a117_employeeothercompansation : NULL);
	             			$otherCompensationType = (($qualification->coborrower) ? $qualification->borrower->a117_employeeothercompansantiontype : NULL);
	             			$timeOnJob = (($qualification->coborrower) ? $qualification->borrower->a117_employeeduration : NULL);
	             			$previosJob = (($qualification->coborrower) ? $qualification->coborrower->a117_employeebefore : NULL);
	             			$addressJob = (($qualification->coborrower) ? $qualification->coborrower->a117_employeeaddress : NULL);
	             			$zipCodeJob = (($qualification->coborrower) ? $qualification->borrower->a117_employeezipcode : NULL);
	             			
             			?>
             			
             			<table class="table" id="showCo" style="display: none;">
             				<tr>
			             		<td width="120px" >Name *</td>
					            <td width="200px">Lastname *</td>
					            <td width="150px">Mobile *</td>
					            <td width="150px">SSN</td>
				            </tr>
				            <tr>
			             		<td width="25%">{!! Form::text('namecob', $name,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('lastnamecob', $lastname, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('mobilecob', $mobile,  ['class'=> 'form-control', 'id' => 'mobilecob']) !!}</td>
             					<td>{!! Form::text('ssncob', $ssn,  ['class'=> 'form-control', 'id' => 'ssncob']) !!}</td>
			             	</tr>
			             	<tr>
			             		<td width="180px">Date of Birth</td>
					            <td>Civil Status </td>
					            <td >Email</td>
					            
				            </tr>
				            <tr>
			             		<td>{!! Form::text('dobcob', $dob ,  ['class'=> 'form-control', 'id' => 'dob']) !!}</td>
             					<td >{!!Form::select('civilstatuscob', App\Util::getCivilStatus(), $civilstatus, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
             				    <td colspan="2">{!! Form::text('emailcob', $email,  ['class'=> 'form-control', 'id' => 'email']) !!}</td>
				          	</tr>
				          	<tr>
				             	<th colspan="4" align="center"><br/><h5>Address Information</h5></th>
			             	</tr>
			             	<tr>
			             		<td>Country</td>
			             		<td>State</td>
			             		<td>City</td>
			             		<td>ZipCode</td>
			             	</tr>
			             	<tr>
			             		<td>{!!Form::select('countrycob',  $country, null, ['id' =>
									'countrycob', 'class'=> 'form-control', 'onchange' =>
									"getStates(this.value, 0, 'statecob' )"])!!}</td>
			             		<td>{!!Form::select('statecob', ["" => 'Select state'], null, ['id' => 'statecob', 'class'=> 'form-control', 'onchange' => "getCities(this.value, 0, 'citycob')"]) !!}</td>
			             		<td>{!!Form::select('citycob', ["" => "Select city"], null, ['id' => 'citycob', 'class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('zipcodecob', $zipCodeJob,  ['class'=> 'form-control', 'id' => 'zipcode']) !!}</td>
			             	</tr>
			             	<tr>
			             		<td>Address</td>
			             		<td>Pity / Rent</td>
			             		<td >Housing situation</td>
			             		<td >Months living here</td>
			             	</tr>
			             	<tr>
			             		<td >{!! Form::text('addresscob', $address,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('rentcob',  $pity,  ['class'=> 'form-control', 'id' => 'rentcob']) !!}</td>
			             		<td>
			             			{!!Form::radio('housingcob', 'Own', ($typehouse == 'Own' ? 1 : 0), ['class'=> ''])!!} Own &nbsp;&nbsp;&nbsp;
									{!!Form::radio('housingcob', 'Rent', ($typehouse == 'Rent' ? 1 : 0),  ['class'=> ''])!!} Rent</label>					
								</td>
								<td>{!!Form::selectRange('timeoflivingcob', 0, 30,  $livingtime, ['class'=> 'form-control', 'onchange' => "showOtherAddress(this.value, 'bSecondAddressCob');"])!!}</td>
			             	</tr>
			             	<tr id="bSecondAddressCob" style="display: none">
			             		<td colspan="4">Previous address:  {!! Form::text('addresscobprevious', $previousaddress,  ['class'=> 'form-control']) !!}<br/></td>
			             	</tr>
			             	
			             	
			             	<tr>
				             	<th colspan="4" align="center"><br/><h5>Employee Information</h5></th>
			             	</tr>
			             	<tr>
			             		<td width="120px" >Self Employed</td>
			             		<td width="120px" >Employer </td>
					            <td width="200px">Position </td>
					            <td width="150px">Phone  </td>
				            </tr>
				            <tr>
			             		<td>{!! Form::checkbox('selfemployeecob', 1, $selfEmployed, ['class'=> 'checkbox1', 'style'=> 'font-size: 10px;']) !!}</td>
			             		<td width="25%">{!! Form::text('employercob', $employer,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('positioncob', $position, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('phonecob', $phone,  ['class'=> 'form-control', 'id' => 'phonecob']) !!}</td>
			             	</tr>
			             	
			             	<tr>
			             		<td >Basic salary </td>
			             		<td width="200px">Oher compensation</td>
					            <td width="150px">Oher Compensation type </td>
					           	<td width="120px" >Months in this job </td>
				            </tr>
				            <tr>
			             		<td>{!! Form::text('salarycob', $salary,  ['class'=> 'form-control']) !!}</td>
             					<td>{!! Form::text('compensationcob', $otherCompensation, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::select('compensationtype1cob', App\Util::getCompensationType(),  $otherCompensationType, ['class'=> 'form-control']) !!}</td>
             					<td width="25%">{!! Form::selectRange('timejobcob', 0, 30,  $timeOnJob, ['class'=> 'form-control', 'onchange' => "showOtherAddress(this.value, 'bSecondJobCob');"])!!}</td>
			             	</tr>
			             	 
				            <tr id="bSecondJobCob" style="display: none">
			             		<td colspan="4">Previous job:  {!! Form::text('previousjobcob', $previosJob,  ['class'=> 'form-control']) !!}<br/></td>
			             	</tr>
			             	
			             	<tr>
			             		<th colspan="4" align="center"><br/><h5>Address</h5></th>
			             	</tr>
			             	<tr>
			             		<td>Country</td>
			             		<td>State</td>
			             		<td>City</td>
			             	</tr>
			             	<tr>
			             		<td>{!!Form::select('countryjobcob',  $country, null, ['id' =>
									'countryjobcob', 'class'=> 'form-control', 'onchange' =>
									"getStates(this.value, 0, 'statejobcob')"])!!}</td>
			             		<td>{!!Form::select('statejobcob', ["" => 'Select state'], null, ['id' => 'statejobcob', 'class'=> 'form-control', 'onchange' => "getCities(this.value, 0, 'cityjobcob')"]) !!}</td>
			             		<td>{!!Form::select('cityjobcob', ["" => "Select city"], null, ['id' => 'cityjobcob', 'class'=> 'form-control']) !!}</td>
			             		
			             	</tr>
			             	<tr>
			             		<td colspan="2">Address</td>
			             		<td >ZipCode</td>
			             		
			             	</tr>
			             	<tr>
				             	<td colspan="2"> {!! Form::text('addressjobcob', $addressJob,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('zipcodejobcob', $zipCodeJob,  ['class'=> 'form-control', 'id' => 'zipcode']) !!}</td>
				             </tr>
             			</table>
             		</th>
             	</tr>
             	
             	<tr>
             		<td width="50%"><br/><h4>Borrower comments * </h4> 
             			{!! Form::textarea('borrowercomments', $qualification->a119_commentsborrower,  ['class'=> 'form-control', 'id' => 'email2']) !!}
             		</td>
             	</tr>	
             	<tr>
             		<td width="50%"> <br/><h4>Case comments * </h4>
             			{!!Form::textarea('casecomments',  $qualification->a119_commentscase, ['class'=> 'form-control'])!!}
             		</td>
             	</tr>
             	
             	<?php 
	             	$roleId = Session::get('active_user')['a104_roleid'];
             	?>
             	@if($roleId < 3)
		   		 <tr>
             		<td colspan="4"><br/><h4>Lender Exclusive Use</h4> 
             			{!! Form::textarea('feedback', $qualification->a119_feedback,  ['class'=> 'form-control']) !!}
             		</td>
             	 </tr>
				@endif
             	
             	
             </table>
         
			
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">{!! Form::submit('Submit',
					['class'=> 'btn-success btn']) !!} {!! Form::button('Back',
					['class'=> 'btn-default btn', 'onclick'=>
					'javascript:history.back();']) !!}</div>
			</div>
		{!! Form::close() !!}

 <!-- CALENDAR -->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

<script type="text/javascript">
	//Property address
	
	if( "{!! old('state') !!}" == "")
	{  
		getStates( "1", "{!! $qualification->a119_stateid !!} ");
		getCities( "{!! $qualification->a119_stateid !!}", "{!! $qualification->a119_cityid !!}");
	
		//Borrower address
		getStates( "1", "{!! $qualification->borrower->a117_stateid !!}", 'stateb');
		getCities( "{!! $qualification->borrower->a117_stateid !!}", "{!! $qualification->borrower->a117_cityid !!}", 'cityb');

		//Borrower job address
		getStates( "1", "{!! $qualification->borrower->a117_employeestateid !!}", 'statejob'); 
		getCities( "{!! $qualification->borrower->a117_employeestateid !!}", "{!! $qualification->borrower->a117_employeecityid !!}", 'cityjobb');
		
	<?php 
		if(isset($qualification->coborrower))
		{
	?>
			//Coborrower address
			getStates( "{!! $qualification->coborrower->state->a002_countryid !!}", "{!! $qualification->coborrower->a117_stateid !!}", 'statecob');
			getCities( "{!! $qualification->coborrower->a117_stateid  !!}", "{!! $qualification->coborrower->a117_cityid !!}", 'citycob'); //cityjob
			
			//Coborrower job address
			getStates( "{!! $qualification->coborrower->stateJob->a002_countryid !!}", "{!! $qualification->coborrower->a117_employeestateid !!}", 'statejobcob');
			getCities( "{!! $qualification->coborrower->a117_employeestateid !!}", "{!! $qualification->coborrower->a117_employeecityid !!}", 'cityjobcob');
	<?php 
		}
	?>
	}
	else
	{
		getStates( "{!! old('country') !!}", "{!! old('state') !!} ");
		getCities( "{!! old('state') !!}", "{!! old('city') !!}");

		//Borrower address
		getStates( "{!! old('countryb') !!}", "{!! old('stateb') !!}", 'stateb');
		getCities( "{!! old('stateb') !!}", "{!! old('cityb') !!}", 'cityb');

		//Borrower job address
		getStates( "{!! old('countryjobb') !!}", "{!! old('statejob') !!}", 'statejob');
		getCities( "{!! old('statejob') !!}", "{!! old('cityjobb') !!}", 'cityjobb');
		
		//Coborrower address
		getStates( "{!! old('countrycob') !!}", "{!! old('statecob') !!}", 'statecob');
		getCities( "{!! old('statecob') !!}", "{!! old('citycob') !!}", 'citycob'); //cityjob
		
		//Coborrower job address
		getStates( "{!! old('countryjobcob') !!}", "{!! old('statejobcob') !!}", 'statejobcob');
		getCities( "{!! old('statejobcob') !!}", "{!! old('cityjobcob') !!}", 'cityjobcob');
	}
	

</script>
 
 <script type="text/javascript">
  	jQuery(function($){
	   $("#mobile").mask("(999) 999-9999"); 
	   $("#mobilecob").mask("(999) 999-9999");
	   $("#phonecob").mask("(999) 999-9999"); 
	   $("#phoneb").mask("(999) 999-9999"); 
	   $("#ssn").mask("999-99-9999");
	   $("#ssncob").mask("999-99-9999");
	});

	 $( "#dob" ).datepicker({
	    changeMonth: true,
	    changeYear: true
	 });

	 $( "#dobcob" ).datepicker({
	    changeMonth: true,
	    changeYear: true
	  });

	function otherPurposeF(appliedFor)
	{
		if(appliedFor != 14) 
		{
			$('#otherPurpose').prop({"readonly": true});
			$('#otherPurpose').val("");
		}
		else
		{
			$('#otherPurpose').focus();
			$('#otherPurpose').prop({"readonly": false});
		}		
	}	

	function showOtherAddress(month, divToShow)
	{
		if(month <= 24)  
		{
			$('#'+divToShow).css({"display": ""});
		}	
		else
		{
			$('#'+divToShow).css({"display": "none"});
		}	
	}

	function showCoborrower(marked)
	{
		if(marked.checked == true) 
			document.getElementById("showCo").style.display = "inline";
		else
			document.getElementById("showCo").style.display = "none";
	}
	
	otherPurposeF( "{!! old('loanPurpose') !!}");
	
</script>
@endsection
