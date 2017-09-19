
@extends('layouts.master')

@section('content')
    

<script type="text/javascript">

	getStates( "{!! old('country') !!}", "{!! old('state') !!}");
	getCities( "{!! old('state') !!}", "{!! old('city') !!}");
	
</script>
       
    <h3 class="blank1">Modify Express 1003</h3>
        
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
		
		 {!! Form::open(array('action' => 'TransactionController@update', 'class' => 'form-horizontal')) !!}
              {!! Form::hidden('id', $transaction->a116_id ) !!}            
             <table class="table  table-bordered " style="width: 60%" >
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
			             		<td><b>Created by</b></td>
			             		<td ><b>Loan officer</b></td>
			             		<td><b>Origination date</b></td>
			             		<td><b>Closing date</b></td>
			             		<td ><b>Status</b></td>
			             	</tr>
			             	<tr>
			             		<td> {!! $transaction->createdBy->a102_name!!} {!! $transaction->createdBy->a102_lastname !!}</td>
			             		<td> {!! Form::select('associateid', $associates, $transaction->a116_associateid, ['class'=> 'form-control', 'style' =>'width: 100px;' ])!!}</td>			             		
			             		<td>{!! Form::text('origindate', App\Util::getStringFormat3($transaction->a116_origindate),  ['class'=> 'form-control', 'style' =>'width: 100px;', 'id' => 'origindate']) !!}</td>
			             		<td>{!! Form::text('closuredate', App\Util::getStringFormat3($transaction->a116_closingdate),  ['class'=> 'form-control', 'style' =>'width: 100px;', 'id' => 'closuredate']) !!}</td>
			             		<td> {!! Form::select('status', $status, $transaction->a116_status, ['class'=> 'form-control', 'style' =>'width: 180px;' ])!!}</td>
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
				            	<td>{!! Form::text('amount', $transaction->a116_amount, ['class'=> 'form-control', 'id'=> 'amount']) !!}</td>
						        <td>{!!Form::select('appliedfor', $appliedFor, $transaction->a116_appliedfor, [ 'onChange' => 'otherAppliedF(this.value);', 'class'=> 'form-control'])!!}</td>
						        <td>{!! Form::text('interest', $transaction->a116_interestrate, ['class'=> 'form-control', 'style' =>'width: 100px;']) !!} </td>
						        <td>{!! Form::text('loannumber', $transaction->a116_loannumber, ['class'=> 'form-control', 'id'=> 'loannumber']) !!}</td>
						    </tr>
						    
						    <tr>
			             		<td width="120px" >Number of months</td>
			             		<td>Amortization Type</td>
			             		<td >Other Amortization Type</td>
			             		<td >Commercial Property </td>
			             	</tr>
			             	
			             	<tr>
			             		<td>{!! Form::text('monthnumber', $transaction->a116_monthnumber,  ['class'=> 'form-control',  'id' => 'monthnumber']) !!}</td>
			             		<td>{!! Form::select('amortizationtype', $amortizationType, $transaction->a116_amortizationtypeid, ['onChange' => 'otherAmortizationF(this.value);', 'class'=> 'form-control', 'id' => 'amortizationType'])!!}</td>
			             		<td>{!! Form::text('otheramortization', $transaction->a116_amortizationtypeoptional,  ['class'=> 'form-control', 'readonly' => 'true', 'id' => 'otherAmortization']) !!}</td>
			             		<td>{!! Form::checkbox('iscommercial', 1, null, ['class'=> 'checkbox1', 'id'=> 'goal']) !!} &nbsp;Commercial</td>
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
			             		<td>{!!Form::select('country',  $country, $transaction->a116_countryid, ['id' =>
										'country', 'class'=> 'form-control', 'onchange' => 'getStates(this.value)'])!!}</td>
			             		<td>{!!Form::select('state', $state, $transaction->a116_stateid, ['id' => 'state', 'class'=> 'form-control', 'onchange' => 'getCities(this.value)']) !!}</td>
			             		<td>{!!Form::select('city', ["" => "Select city"], null, ['id' => 'city', 'class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('zipcode', $transaction->a116_zipcode,  ['class'=> 'form-control', 'id' => 'zipcode', 'placeholder' => 'Zipcode']) !!}</td>
			             	</tr>
			             	
			             	
			             	<tr>
			             		<td></td>
			             		
			             		<td></td>
			             		<td></td>
			             	</tr>
			             	<tr>
			             		<td colspan="4"> {!! Form::text('address', $transaction->a116_address,  ['class'=> 'form-control', 'placeholder' => 'Address']) !!}<br/></td>
			             	</tr>
			             	
			             	<tr>
			             		<td>Property use</td>
			             		<td>Units number</td>
			             		<td>Loan Purpose </td>
			             		<td>Specify other loan purpose</td>
			             	</tr>
			             	<tr>
			             		<td>{!!Form::select('propertyuse', $propertyUse, $transaction->a116_propertyuse, ['class'=> 'form-control'])!!}</td>
			             		<td>{!! Form::text('unitsnumber', $transaction->a116_unitsnumber,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!!Form::select('loanpurpose', $loanPurpose, $transaction->a116_loanpurpose, ['onChange' => 'otherPurposeF(this.value);', 'class'=> 'form-control'])!!}</td>
			             		<td>{!! Form::text('otherpurpose', $transaction->a116_loanpurposeother,  ['class'=> 'form-control', 'id' => 'otherPurpose', 'readonly' => 'true']) !!}</td>
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
							        	<td>{!! Form::text('refinanceyearacquired', $transaction->a116_refinanceyearacquired,  ['class'=> 'form-control']) !!}</td>
							            <td>{!! Form::text('refinancecost', $transaction->a116_refinancecost,  ['class'=> 'form-control'])  !!}</td>
							            <td>{!!Form::select('refinancepurpose', $refinancePurpose, $transaction->a116_refinancepurpose, ['class'=> 'form-control'])!!}</td>
							            <td>{!! Form::text('refinanceliense', $transaction->a116_refinanceliensexisting,  ['class'=> 'form-control']) !!}</td>
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
			             		<td width="120px">Name *</td>
					            <td width="200px">Lastname *</td>
					            <td width="180px">Mobile *</td>
					            <td >SSN</td>
				            </tr>
				            <tr>
			             		<td width="25%">{!! Form::text('name', $transaction->borrower->a117_name,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('lastname', $transaction->borrower->a117_lastname, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('mobile', $transaction->borrower->a117_mobile,  ['class'=> 'form-control', 'id' => 'mobile', 'placeholder' => '']) !!}</td>
             					<td>{!! Form::text('ssn', $transaction->borrower->a117_ssn,  ['class'=> 'form-control', 'id' => 'ssn', 'placeholder' => 'SSN']) !!}</td>
			             	</tr>
			             	<tr>
			             		<td width="180px">Date of Birth</td>
					            <td>Civil Status </td>
					            <td ></td>
					            <td ></td>
				            </tr>
				            <tr>
			             		<td>{!! Form::text('dob', App\Util::getStringFormat3($transaction->borrower->a117_dob),  ['class'=> 'form-control', 'id' => 'dob']) !!}</td>
             					<td >{!!Form::select('civilstatus', App\Util::getCivilStatus(), $transaction->borrower->a117_civilstatus, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
             				    <td ></td>
             				     <td ></td>
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
					            <td width="180px">Mobile </td>
					            <td >SSN</td>
				            </tr>
				            <?php 
				            	$name = (($transaction->coborrower) ? $transaction->coborrower->a117_name : NULL);
				            	$dob = (($transaction->coborrower) ? App\Util::getStringFormat3($transaction->coborrower->a117_dob) : NULL);;
				            	$civilstatus = (($transaction->coborrower) ? $transaction->coborrower->a117_civilstatus : NULL);
				            	$lastname = (($transaction->coborrower) ? $transaction->coborrower->a117_lastname : NULL);
				            	$mobile = (($transaction->coborrower) ? $transaction->coborrower->a117_mobile : NULL);
				            	$ssn = (($transaction->coborrower) ? $transaction->coborrower->a117_ssn : NULL);
				            ?>
				            <tr>
			             		<td width="25%">{!! Form::text('name2', $name ,  ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('lastname2', $lastname, ['class'=> 'form-control']) !!}</td>
			             		<td>{!! Form::text('mobile2', $mobile,  ['class'=> 'form-control', 'id' => 'mobile2', 'placeholder' => '']) !!}</td>
             					<td>{!! Form::text('ssn2', $ssn,  ['class'=> 'form-control', 'id' => 'ssn2']) !!}</td>
			             	</tr>   
			             	<tr>
			             		<td width="180px">Date of Birth</td>
					            <td colspan="2">Civil Status </td>
					            <td ></td>
					            <td ></td>
				            </tr>
				            <tr>
			             		<td>{!! Form::text('dob2', $dob,  ['class'=> 'form-control', 'id' => 'dob2']) !!}</td>
             					<td>{!!Form::select('civilstatus2', App\Util::getCivilStatus(), $civilstatus, ['class'=> 'form-control', 'id' => 'my-select'])!!}</td>
             					<td ></td>
             					<td ></td>          		
			             	</tr>
             			</table>
             		</th>
             	</tr>
             </table>
         
			
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">{!! Form::submit('Update',
					['class'=> 'btn-success btn']) !!} {!! Form::button('Back',
					['class'=> 'btn-default btn', 'onclick'=>
					'javascript:history.back();']) !!}</div>
			</div>
		{!! Form::close() !!}

 <!-- CALENDAR -->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

 
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

	$('#number').text(function () { 
	    var str = $(this).html() + ''; 
	    x = str.split('.'); 
	    x1 = x[0]; x2 = x.length > 1 ? '.' + x[1] : ''; 
	    var rgx = /(\d+)(\d{3})/; 
	    while (rgx.test(x1)) { 
	        x1 = x1.replace(rgx, '$1' + ',' + '$2'); 
	    } 
	    $(this).html(x1 + x2); 
	});

	otherAmortizationF(document.getElementById("amortizationType").value);
	otherPurposeF({!! $transaction->a116_loanpurpose !!});
	getCities(document.getElementById("state").value, {!! $transaction->a116_cityid !!}  )
	
</script>
@endsection
