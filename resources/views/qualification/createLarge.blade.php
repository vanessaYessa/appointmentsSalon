
@extends('layouts.master')

@section('content')
    
    <h3 class="blank1">Pre Qualification Form</h3>
    
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
		
		
		 {!! Form::open(array('action' => 'QualificationController@store', 'class' => 'form-horizontal')) !!}
              
             <table class="table  table-bordered " style="width: 80%" >
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
			             		<td colspan="2" >Member</td>
			             	</tr>
			             	<tr>
			            		<td colspan="2"> {!! Form::select('associateid', $associates, null, ['class'=> 'form-control', 'style' =>'width: 180px;' ])!!}</td>
			            		
			            		<td> <h3 class="blank1" style="float: right;">Deal Center</h3> </td>
			             	</tr>
			             	
			             	
             			</table>
             		</th>
             	</tr>
             	             	
             	<tr>
             		<th colspan="4">
             			<table class="table" style="width: 60%;">
             				<tr>
				             	<th colspan="4" ><h4>Type of Mortage and purpose of Loan</h4></th>
			             	</tr>
			             	<tr> 
			             	    <td width="200px">Applied for</td>
			             	    <td>Loan Purpose </td>
			             		<td>Specify other loan purpose</td>
			                </tr>
				            <tr>
				                <td>{!!Form::select('appliedFor', $appliedFor, null, ['id' => 'my-select',  'onChange' => 'otherAppliedF(this.value);', 'class'=> 'form-control'])!!}</td>
				                <td>{!!Form::select('loanPurpose', $loanPurpose, null, ['id' => 'loanPurpose', 'onChange' => 'otherPurposeF(this.value);', 'class'=> 'form-control'])!!}</td>
			             		<td>{!! Form::text('otherPurpose', '',  ['class'=> 'form-control', 'id' => 'otherPurpose', 'readonly' => 'true']) !!}</td>
			                </tr>
						 		<td>Property use</td>
			                	<td>Units number</td>
						    </tr>
			             	<tr>
			             		<td>{!!Form::select('propertyuse', $propertyUse, null, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
			             		<td>{!! Form::text('unitsnumber', '',  ['class'=> 'form-control']) !!}</td>
			             	</tr>
			             	<tr>
             			</table>
             		</th>
             	</tr>
             	
             	<tr>
             		<th colspan="4">
             			<table class="table" style="width: 60%;">
             				<tr>
					        	<th colspan="4"><h4>Property information</h4></th>
			             	</tr>
			             	<tr>
			             		<td>Country</td>
			             		<td>State</td>
			             		<td>City</td>
			             	</tr>
			             	<tr>
			             		<td>{!!Form::select('country',  $country, null, ['id' =>
							'country', 'class'=> 'form-control', 'onchange' =>
							'getStates(this.value)'])!!}</td>
			             		<td>{!!Form::select('state', ["" => 'Select state'], null, ['id' => 'state', 'class'=> 'form-control', 'onchange' => 'getCities(this.value)']) !!}</td>
			             		<td>{!!Form::select('city', ["" => "Select city"], null, ['id' => 'city', 'class'=> 'form-control']) !!}</td>
			             	</tr>
			             	
			             	<tr>
			             		<td colspan="3">Address</td>
			             		<td>ZipCode</td>
			             	</tr>
			             	
			             	<tr>
			             		<td colspan="3"> {!! Form::text('address', null,  ['class'=> 'form-control']) !!}<br/></td>
			             		<td>{!! Form::text('zipcode', null,  ['class'=> 'form-control', 'id' => 'zipcode']) !!}</td>
			             	</tr>
             			</table>
             		</th>
             	</tr>
             	
             	<tr>
             		<th colspan="2">
             			<table class="table" >
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
			             		<td width="25%">{!! Form::text('name', $prospect->a103_name,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('lastname', $prospect->a103_lastname, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('mobile', $prospect->a103_mobile,  ['class'=> 'form-control', 'id' => 'mobile']) !!}</td>
             					<td>{!! Form::text('ssn', '',  ['class'=> 'form-control', 'id' => 'ssn']) !!}</td>
			             	</tr>
			             	<tr>
			             		<td width="180px">Date of Birth</td>
					            <td>Civil Status </td>
					            <td >Email</td>
					            
				            </tr>
				            <tr>
			             		<td>{!! Form::text('dob', '',  ['class'=> 'form-control', 'id' => 'dob']) !!}</td>
             					<td >{!!Form::select('civilstatus', App\Util::getCivilStatus(), null, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
             				    <td colspan="2">{!! Form::text('email', '',  ['class'=> 'form-control', 'id' => 'email']) !!}</td>
					            
			             	</tr>
			             	
			             	<tr>
				             	<th colspan="4" align="center"><br/><h5>Address Information</h5></th>
			             	</tr>
			             	<tr>
			             		<td>Country</td>
			             		<td>State</td>
			             		<td>City</td>
			             	</tr>
			             	<tr>
			             		<td>{!!Form::select('countryb',  $country, null, ['id' =>
									'countryb', 'class'=> 'form-control', 'onchange' =>
									"getStates(this.value, 0, 'stateb' )"])!!}</td>
			             		<td>{!!Form::select('stateb', ["" => 'Select state'], null, ['id' => 'stateb', 'class'=> 'form-control', 'onchange' => "getCities(this.value, 0, 'cityb')"]) !!}</td>
			             		<td>{!!Form::select('cityb', ["" => "Select city"], null, ['id' => 'cityb', 'class'=> 'form-control']) !!}</td>
			             		
			             	</tr>
			             	
			             	<tr>
			             		<td colspan="2">Address</td>
			             		<td>ZipCode</td>
			             		<td >Time living here </td>
			             	</tr>
			             	
			             	<tr>
			             		<td colspan="2"> {!! Form::text('addressb', null,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('zipcodeb', null,  ['class'=> 'form-control', 'id' => 'zipcode']) !!}</td>
			             		<td>{!!Form::selectRange('timeoflivingb', 0, 30,  null, ['class'=> 'form-control', 'style' => 'width:60px', 'onchange' => "showOtherAddress(this.value, 'bSecondAddress');"])!!} years</td>
			             	</tr>
			             	
			             	<tr id="bSecondAddress" style="display: none">
			             		<td colspan="4">Previous address:  {!! Form::text('addressbprevious', null,  ['class'=> 'form-control', ]) !!}<br/></td>
			             	</tr>
			             	
			             	
			             	<tr>
				             	<th colspan="4" align="center"><br/><h5>Employee Information</h5></th>
			             	</tr>
			             	<tr>
			             		<td width="120px" >Employer *</td>
					            <td width="200px">Position *</td>
					            <td width="150px">Phone  *</td>
					            <td >Basic salary *</td>
				            </tr>
				            <tr>
			             		<td width="25%">{!! Form::text('employerb', null,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('positionb', null, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('phoneb', null,  ['class'=> 'form-control', 'id' => 'phoneb']) !!}</td>
             					<td>{!! Form::text('salaryb', null,  ['class'=> 'form-control']) !!}
             					</td>
			             	</tr>
			             	
			             	<tr>
			             		<td width="200px">Oher compensation</td>
					            <td width="150px">Oher Compensation type *</td>
					           <td width="120px" >Years on job *</td>
					            <td ></td>
				            </tr>
				           
				            <tr>
			             		<td>{!! Form::text('compensationb', null, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::select('compensationtype1b', App\Util::getCompensationType(),  null, ['class'=> 'form-control', 'id' => 'mobile']) !!}</td>
             					<td width="25%">{!! Form::selectRange('timejobb', 0, 30,  null, ['class'=> 'form-control', 'id' => 'my-select', 'onchange' => "showOtherAddress(this.value, 'bSecondJob');"])!!}</td>
			             		<td></td>
			             	</tr>
			             	 
				            <tr id="bSecondJob" style="display: none">
			             		<td colspan="4">Previous job:  {!! Form::text('previousjobb', null,  ['class'=> 'form-control']) !!}<br/></td>
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
			             		<td>{!!Form::select('countryjobb',  $country, null, ['id' =>
									'countryjob', 'class'=> 'form-control', 'onchange' =>
									"getStates(this.value, 0, 'statejob')"])!!}</td>
			             		<td>{!!Form::select('statejobb', ["" => 'Select state'], null, ['id' => 'statejob', 'class'=> 'form-control', 'onchange' => "getCities(this.value, 0, 'cityjob')"]) !!}</td>
			             		<td>{!!Form::select('cityjobb', ["" => "Select city"], null, ['id' => 'cityjob', 'class'=> 'form-control']) !!}</td>
			             		
			             	</tr>
			             	<tr>
			             		<td colspan="2">Address</td>
			             		<td >ZipCode</td>
			             		
			             	</tr>
			             	<tr>
				             	<td colspan="2"> {!! Form::text('addressjobb', null,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('zipcodejob', null,  ['class'=> 'form-control', 'id' => 'zipcode']) !!}</td>
				             </tr>
             			</table>
             		</th>
             		
             		<th colspan="2">
             			<table class="table" style="display: none">
             				<tr>
				             	<th colspan="4" ><h4>Coborrower Information</h4></th>
			             	</tr>
			             	<tr>
			             		<td width="120px" >Name *</td>
					            <td width="200px">Lastname *</td>
					            <td width="150px">Mobile *</td>
					            <td width="150px">SSN</td>
				            </tr>
				            <tr>
			             		<td width="25%">{!! Form::text('name', null,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('lastname', null, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('mobile', null,  ['class'=> 'form-control', 'id' => 'mobile']) !!}</td>
             					<td>{!! Form::text('ssn', null,  ['class'=> 'form-control', 'id' => 'ssn']) !!}</td>
			             	</tr>
			             	<tr>
			             		<td width="180px">Date of Birth</td>
					            <td>Civil Status </td>
					            <td >Email</td>
					            
				            </tr>
				            <tr>
			             		<td>{!! Form::text('dob', '',  ['class'=> 'form-control', 'id' => 'dob']) !!}</td>
             					<td >{!!Form::select('civilstatus', App\Util::getCivilStatus(), null, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
             				    <td colspan="2">{!! Form::text('email', '',  ['class'=> 'form-control', 'id' => 'email']) !!}</td>
					            
			             	</tr>
			             	
			             	<tr>
				             	<th colspan="4" align="center"><br/><h5>Address Information</h5></th>
			             	</tr>
			             	<tr>
			             		<td>Country</td>
			             		<td>State</td>
			             		<td>City</td>
			             	</tr>
			             	<tr>
			             		<td>{!!Form::select('countrycob',  $country, null, ['id' =>
									'countryb', 'class'=> 'form-control', 'onchange' =>
									"getStates(this.value, 0, 'statecob' )"])!!}</td>
			             		<td>{!!Form::select('statecob', ["" => 'Select state'], null, ['id' => 'statecob', 'class'=> 'form-control', 'onchange' => "getCities(this.value, 0, 'citycob')"]) !!}</td>
			             		<td>{!!Form::select('citycob', ["" => "Select city"], null, ['id' => 'citycob', 'class'=> 'form-control']) !!}</td>
			             		
			             	</tr>
			             	
			             	<tr>
			             		<td colspan="2">Address</td>
			             		<td>ZipCode</td>
			             		<td >Time living here (in years)</td>
			             	</tr>
			             	
			             	<tr>
			             		<td colspan="2"> {!! Form::text('addresscob', null,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('zipcodecob', null,  ['class'=> 'form-control', 'id' => 'zipcode']) !!}</td>
			             		<td>{!!Form::selectRange('timeoflivingcob', 0, 30,  null, ['class'=> 'form-control', 'onchange' => "showOtherAddress(this.value, 'bSecondAddressCob');"])!!}</td>
			             	</tr>
			             	
			             	<tr id="bSecondAddressCob" style="display: none">
			             		<td colspan="4">Previous address:  {!! Form::text('addresscobprevious', null,  ['class'=> 'form-control']) !!}<br/></td>
			             	</tr>
			             	
			             	
			             	<tr>
				             	<th colspan="4" align="center"><br/><h5>Employee Information</h5></th>
			             	</tr>
			             	<tr>
			             		<td width="120px" >Employer *</td>
					            <td width="200px">Position *</td>
					            <td width="150px">Phone  *</td>
					            <td >Basic salary *</td>
				            </tr>
				            <tr>
			             		<td width="25%">{!! Form::text('employercob', null,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('positioncob', null, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('phonecob', null,  ['class'=> 'form-control', 'id' => 'phonecob']) !!}</td>
             					<td>{!! Form::text('salarycob', null,  ['class'=> 'form-control']) !!}
             					</td>
			             	</tr>
			             	
			             	<tr>
			             		<td width="200px">Oher compensation</td>
					            <td width="150px">Oher Compensation type *</td>
					           <td width="120px" >Years on job *</td>
					            <td ></td>
				            </tr>
				           
				            <tr>
			             		<td>{!! Form::text('compensationcob', null, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::select('compensationtype1cob', App\Util::getCompensationType(),  null, ['class'=> 'form-control']) !!}</td>
             					<td width="25%">{!! Form::selectRange('timejobcob', 0, 30,  null, ['class'=> 'form-control', 'onchange' => "showOtherAddress(this.value, 'bSecondJobCob');"])!!}</td>
			             		<td></td>
			             	</tr>
			             	 
				            <tr id="bSecondJobCob" style="display: none">
			             		<td colspan="4">Previous job:  {!! Form::text('previousjobcob', null,  ['class'=> 'form-control']) !!}<br/></td>
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
				             	<td colspan="2"> {!! Form::text('addressjobcob', null,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('zipcodejobcob', null,  ['class'=> 'form-control', 'id' => 'zipcode']) !!}</td>
				             </tr>
             			</table>
             		</th>
             	</tr>
             	
             	
             	<tr>
             		<td colspan="2">Borrower comments</td>
             		<td colspan="2">Case comments</td>
             	</tr>
             	
             	<tr>
             		<td colspan="2">{!! Form::textarea('borrowercomments', null,  ['class'=> 'form-control', 'id' => 'email2']) !!}</td>
					<td colspan="2">{!!Form::textarea('casecomments',  null, ['class'=> 'form-control'])!!}</td>
             	</tr>
             	
             	
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
	document.getElementById("background").className  = "";
	
	getStates( "{!! old('country') !!}", "{!! old('state') !!}");
	getCities( "{!! old('state') !!}", "{!! old('city') !!}");

	getStates( "{!! old('countryb') !!}", "{!! old('stateb') !!}");
	getCities( "{!! old('stateb') !!}", "{!! old('cityb') !!}");

	getStates( "{!! old('countryjob') !!}", "{!! old('statejob') !!}");
	getCities( "{!! old('statejob') !!}", "{!! old('cityjob') !!}");
	

</script>
 
 <script type="text/javascript">
  	jQuery(function($){
	   $("#mobile").mask("(999) 999-9999"); //mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
	   $("#mobile2").mask("(999) 999-9999"); //mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
	   
	   $("#ssn").mask("999-99-9999"); //mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
	   $("#ssn2").mask("999-99-9999");
	});

	 $( "#dob" ).datepicker({
	    changeMonth: true,
	    changeYear: true
	  });

	 $( "#dob2" ).datepicker({
	    changeMonth: true,
	    changeYear: true
	  });
/*
	 $( "#origindate" ).datepicker({
	    changeMonth: true,
	    changeYear: true
	  });

	 $( "#closuredate" ).datepicker({
	    changeMonth: true,
	    changeYear: true
	  });	 */
	
	function otherAmortizationF(appliedFor)
	{
		if(appliedFor != 8)
		{
			$('#otherAmortization').prop({"readonly": true});
			$('#otherAmortization').val("");
		}
		else
		{
			$('#otherAmortization').prop({"readonly": false});
			$('#otherAmortization').focus();
			
		}
	}
	
	
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

	function showOtherAddress(years, divToShow)
	{
		if(years <= 2)  
		{
			$('#'+divToShow).css({"display": ""});
		}	
		else
		{
			$('#'+divToShow).css({"display": "none"});
		}
			
	}	

	otherPurposeF( "{!! old('loanPurpose') !!}");
	
</script>
@endsection
