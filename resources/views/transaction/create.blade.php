
@extends('layouts.master')

@section('content')
    
    <h3 class="blank1">New Express 1003</h3>
        
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
		
		
		 {!! Form::open(array('action' => 'TransactionController@store', 'class' => 'form-horizontal')) !!}
              
             <table class="table  table-bordered " style="width: 60%" >
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
			             		<td>Origination date</td>
			             		<td>Closing date</td>
			             		<td colspan="2">Member</td>
			             		
			             	</tr>
			             	<tr>
			             		<td>{!! Form::text('origindate', '',  ['class'=> 'form-control', 'style' =>'width: 120px;', 'id' => 'origindate']) !!}</td>
			             		<td>{!! Form::text('closuredate', '',  ['class'=> 'form-control', 'style' =>'width: 120px;', 'id' => 'closuredate']) !!}</td>
			             		<td colspan="2"> {!! Form::select('associateid', $associates, null, ['class'=> 'form-control', 'style' =>'width: 180px;' ])!!}</td>
			             		
			             	</tr>
             			</table>
             		</th>
             	</tr>
             	
             	
             	
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
				             	<th colspan="4" ><h4>Type of Mortage and Terms of Loan</h4></th>
			             	</tr>
			             	<tr>
			             		<td width="120px" >Loan amount</td>
					            <td width="200px">Applied for</td>
					            <td width="180px">Interest rate</td>
					            <td >Loan #</td>
				            </tr>
				            <tr>
				            	<td>{!! Form::text('amount', '', ['class'=> 'form-control']) !!}</td>
						        <td>{!!Form::select('appliedfor', $appliedFor, null, ['id' => 'appliedfor',  'onChange' => 'otherAppliedF(this.value);', 'class'=> 'form-control'])!!}</td>
						        <td>{!! Form::text('interest', '', ['class'=> 'form-control', 'style' =>'width: 100px;']) !!} </td>
						        <td>{!! Form::text('loannumber', '', ['class'=> 'form-control', 'id'=> 'loannumber']) !!}</td>
						    </tr>
						    <tr>
			             		<td width="120px" >Number of months</td>
			             		<td>Amortization Type</td>
			             		<td >Other Amortization Type</td>
			             		<td >Commercial Property </td>
			             	</tr>
			             	<tr>
			             		<td>{!! Form::text('monthnumber', '',  ['class'=> 'form-control',  'id' => 'monthnumber']) !!}</td>
			             		<td>{!! Form::select('amortizationtype', $amortizationType, null, ['onChange' => 'otherAmortizationF(this.value);', 'class'=> 'form-control', 'id' => 'amortizationType'])!!}</td>
			             		<td>{!! Form::text('otheramortization', '',  ['class'=> 'form-control', 'readonly' => 'true', 'id' => 'otherAmortization']) !!}</td>
			             		<td>{!! Form::checkbox('iscommercial', 1, null, ['class'=> 'checkbox1']) !!} &nbsp;Commercial</td>
			             	</tr>
             			</table>
             		</th>
             	</tr>
             	
             	
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
					        	<th colspan="4"><h4>Property information and purpose of loan</h4></th>
			             	</tr>
			             	<tr>
			             		<td>Country</td>
			             		<td>State</td>
			             		<td>City</td>
			             		<td>ZipCode</td>
			             	</tr>
			             	<tr>
			             		<td>{!!Form::select('country',  $country, null, ['id' =>
							'country', 'class'=> 'form-control', 'onchange' =>
							'getStates(this.value)'])!!}</td>
			             		<td>{!!Form::select('state', ["" => 'Select state'], null, ['id' => 'state', 'class'=> 'form-control', 'onchange' => 'getCities(this.value)']) !!}</td>
			             		<td>{!!Form::select('city', ["" => "Select city"], null, ['id' => 'city', 'class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('zipcode', null,  ['class'=> 'form-control', 'id' => 'zipcode', 'placeholder' => 'Zipcode']) !!}</td>
			             	</tr>
			             	
			             	<tr>
			             		<td></td>
			             		<td></td>
			             		<td></td>
			             	</tr>
			             	<tr>
			             		<td colspan="4"> {!! Form::text('address', null,  ['class'=> 'form-control', 'placeholder' => 'Address']) !!}<br/></td>
			             	</tr>
			             	
			             	<tr>
			             		<td>Property use</td>
			             		<td>Units number</td>
			             		<td>Loan Purpose </td>
			             		<td>Specify other loan purpose</td>
			             	</tr>
			             	<tr>
			             		<td>{!!Form::select('propertyuse', $propertyUse, null, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
			             		<td>{!! Form::text('unitsnumber', '',  ['class'=> 'form-control']) !!}</td>
			             		<td>{!!Form::select('loanpurpose', $loanPurpose, null, ['id' => 'loanpurpose', 'onChange' => 'otherPurposeF(this.value);', 'class'=> 'form-control'])!!}</td>
			             		<td>{!! Form::text('otherpurpose', '',  ['class'=> 'form-control', 'id' => 'otherpurpose', 'readonly' => 'true']) !!}</td>
			             	</tr>
			             	
			             	
			             	
             			</table>
             		</th>
             	</tr>
             	
             	<tr id="refinanTitlte" style="display: none;">
	             	<td colspan="4">
	             		<table class="table">
             				<tr>
             					<td colspan="4">
             						<tr >
				             			<th colspan="4"><h4>Refinance Loan</h4></th>
					             	</tr>
						            <tr >
					             		<td width="80px">Year acquired </td>
					             		<td width="120px">Original cost</td>
					             		<td width="240px">Refinance Purpose</td>
					             		<td width="120px">Existing loan amount </td>
					             	</tr>
				             		<tr>
							        	<td>{!! Form::text('refinanceyearacquired', '',  ['class'=> 'form-control']) !!}</td>
							            <td>{!! Form::text('refinancecost', '',  ['class'=> 'form-control']) !!}</td>
							            <td>{!!Form::select('refinancepurpose', $refinancePurpose, null, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
							            <td>{!! Form::text('refinanceliense', '',  ['class'=> 'form-control']) !!}</td>
									</tr>
             					</td>
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
					            <td >SSN</td>
				            </tr>
				            <tr>
			             		<td width="25%">{!! Form::text('name', $prospect->a103_name,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('lastname', $prospect->a103_lastname, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('mobile', $prospect->a103_mobile,  ['class'=> 'form-control', 'id' => 'mobile', 'placeholder' => '']) !!}</td>
             					<td>{!! Form::text('ssn', '',  ['class'=> 'form-control', 'id' => 'ssn', 'placeholder' => 'SSN']) !!}</td>
			             	</tr>
			             	<tr>
			             		<td width="180px">Date of Birth</td>
					            <td >Email</td>
					            <td colspan="2">Civil Status </td>
				            </tr>
				            <tr>
			             		<td>{!! Form::text('dob', '',  ['class'=> 'form-control', 'id' => 'dob']) !!}</td>
             					<td>{!! Form::text('email', '',  ['class'=> 'form-control', 'id' => 'email']) !!}</td>
             					<td colspan="2">{!!Form::select('civilstatus', App\Util::getCivilStatus(), null, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
             					
			             	</tr>
             			</table>
             		</th>
             	</tr>
             	
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
				             	<th colspan="4" ><h4>Coborrower Information</h4></th>
			             	</tr>
			             	<tr>
			             		<td width="120px" >Name </td>
					            <td width="200px">Lastname </td>
					            <td width="150px">Mobile </td>
					            <td >SSN</td>
				            </tr>
				            <tr>
			             		<td width="25%">{!! Form::text('name2', '',  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('lastname2', '', ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('mobile2', '',  ['class'=> 'form-control', 'id' => 'mobile', 'placeholder' => '']) !!}</td>
             					<td>{!! Form::text('ssn2', '',  ['class'=> 'form-control', 'id' => 'ssn', 'placeholder' => 'SSN']) !!}</td>
			             	</tr>
			             	<tr>
			             		<td width="180px">Date of Birth</td>
			             		<td >Email</td>
					            <td colspan="2">Civil Status </td>
					            
				            </tr>
				            <tr>
			             		<td>{!! Form::text('dob2', '',  ['class'=> 'form-control', 'id' => 'dob']) !!}</td>
             					<td>{!! Form::text('email2', '',  ['class'=> 'form-control', 'id' => 'email2']) !!}</td>
             					<td colspan="2">{!!Form::select('civilstatus2', App\Util::getCivilStatus(), null, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
			             	</tr>
             			</table>
             		</th>
             	</tr>
             	
             	
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
				             	<th colspan="4" ><h4>Coborrower Information</h4></th>
			             	</tr>
			             	<tr>
			             		<td width="120px" >Name </td>
					            <td width="200px">Lastname </td>
					            <td width="150px">Mobile </td>
					            <td >SSN</td>
				            </tr>
				            <tr>
			             		<td width="25%">{!! Form::text('name2', '',  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('lastname2', '', ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('mobile2', '',  ['class'=> 'form-control', 'id' => 'mobile', 'placeholder' => '']) !!}</td>
             					<td>{!! Form::text('ssn2', '',  ['class'=> 'form-control', 'id' => 'ssn', 'placeholder' => 'SSN']) !!}</td>
			             	</tr>
			             	<tr>
			             		<td width="180px">Date of Birth</td>
			             		<td >Email</td>
					            <td colspan="2">Civil Status </td>
					            
				            </tr>
				            <tr>
			             		<td>{!! Form::text('dob2', '',  ['class'=> 'form-control', 'id' => 'dob']) !!}</td>
             					<td>{!! Form::text('email2', '',  ['class'=> 'form-control', 'id' => 'email2']) !!}</td>
             					<td colspan="2">{!!Form::select('civilstatus2', App\Util::getCivilStatus(), null, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
			             	</tr>
             			</table>
             		</th>
             	</tr>
             	
             	
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
				             	<th colspan="4" ><h4>Coborrower Information</h4></th>
			             	</tr>
			             	<tr>
			             		<td width="120px" >Name </td>
					            <td width="200px">Lastname </td>
					            <td width="150px">Mobile </td>
					            <td >SSN</td>
				            </tr>
				            <tr>
			             		<td width="25%">{!! Form::text('name2', '',  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('lastname2', '', ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('mobile2', '',  ['class'=> 'form-control', 'id' => 'mobile', 'placeholder' => '']) !!}</td>
             					<td>{!! Form::text('ssn2', '',  ['class'=> 'form-control', 'id' => 'ssn', 'placeholder' => 'SSN']) !!}</td>
			             	</tr>
			             	<tr>
			             		<td width="180px">Date of Birth</td>
			             		<td >Email</td>
					            <td colspan="2">Civil Status </td>
					            
				            </tr>
				            <tr>
			             		<td>{!! Form::text('dob2', '',  ['class'=> 'form-control', 'id' => 'dob']) !!}</td>
             					<td>{!! Form::text('email2', '',  ['class'=> 'form-control', 'id' => 'email2']) !!}</td>
             					<td colspan="2">{!!Form::select('civilstatus2', App\Util::getCivilStatus(), null, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
			             	</tr>
             			</table>
             		</th>
             	</tr>
             	
             </table>
         
			
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					{!! Form::submit('Create', ['class'=> 'btn-success btn']) !!}
					{!! Form::button('Back', ['class'=> 'btn-default btn', 'onclick'=> 'javascript:history.back();']) !!}</div>
				</div>
			</div>
		{!! Form::close() !!}

 <!-- CALENDAR -->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

<script type="text/javascript">
	
	getStates( "{!! old('country') !!}", "{!! old('state') !!}");
	getCities( "{!! old('state') !!}", "{!! old('city') !!}");
	
	otherPurposeF( "{!! old('loanpurpose') !!}");
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

	 $( "#origindate" ).datepicker({
	    changeMonth: true,
	    changeYear: true
	  });

	 $( "#closuredate" ).datepicker({
	    changeMonth: true,
	    changeYear: true
	  });	 
	
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
			

		isRefinance(appliedFor);
	}	

	function isRefinance(appliedFor)
	{
		if(appliedFor == 12)  
		{
			$('#refinanTitlte').css({"display": "table-row"});
		}	
		else
		{
			$('#refinanTitlte').css({"display": "none"});
		}
			
	}	
	
</script>
@endsection


