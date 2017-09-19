
@extends('layouts.master')

@section('content')
    
    <script>
		$(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>

    <h3 class="blank1">1003 Form</h3>
        
      
		<style>
			.table>tbody>tr>td{
				padding: 2px 8px 0px 8px !important;
				font-size: 13px;
			}
			.table .table {
				background-color: transparent; 
			}
			
			.table .table>tbody>tr>td {
				font-weight: lighter;
			}
			
		</style>
		      
             <table class="table table-bordered " style="width: 60%" >
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
			             		<td><b>Created by</b></td>
			             		<td ><b>Colamerican</b></td>
			             		<td><b>Origination date</b></td>
			             		<td><b>Closing date</b></td>
			             		<td ><b>Status</b></td>
			             	</tr>
			             	<tr>
			             		<td> {!! $transaction->createdBy->a102_name!!} {!! $transaction->createdBy->a102_lastname !!}</td>
			             		<td> {!! $transaction->associate->a102_name!!} {!! $transaction->associate->a102_lastname !!}</td>			             		
			             		<td> {!! App\Util::getStringFormat2($transaction->a116_origindate)!!} </td>
			             		<td> {!! App\Util::getStringFormat2($transaction->a116_closingdate)!!}</td>
			             		<td> {!! $transaction->status->a022_name !!}</td>
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
			             		<td width="120px" ><b>Loan amount</b></td>
					            <td width="200px"><b>Applied for</b></td>
					            <td width="180px"><b>Interest rate</b></td>
					            <td  width="140px"><b>Loan number</b> </td>
				            </tr>
				            <tr>
				            	<td> $ {!! App\Util::formatDecimalNumber($transaction->a116_amount)!!} </td>
				            	<td> {!! $transaction->appliedFor->a021_name!!}</td>
				            	<td> {!! $transaction->a116_interestrate !!}%</td>
				            	<td> {!! $transaction->a116_loannumber!!}</td>
						    </tr>
						    
						    <tr>
			             		<td width="140px" ><b>Number of months</b></td>
			             		<td><b>Amortization Type</b></td>
			             		<td ><b>Other Amortization Type</b></td>
			             		<td ><b>Commercial Property</b> </td>
			             	</tr>
			             	
			             	<tr>
			             		<td> {!! $transaction->a116_monthnumber!!} </td>
			             		<td> {!! $transaction->amortizationType->a021_name!!}</td>
			             		<td> {!! $transaction->a116_amortizationtypeoptional!!}</td>
			             		<td> @if($transaction->a116_commercial == 1)  Yes @else No @endif</td>
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
			             		<td colspan="5"><b>Address:</b> {!! $transaction->a116_address!!}, {!! $transaction->city->a003_name!!},
			             				 {!! $transaction->state->a002_name!!}, {!! $transaction->a116_zipcode!!}<br/><br/> 
			             		</td>
			             	</tr>
			             	
			             	<tr>
			             		<td><b>Property use</b></td>
			             		<td><b>Units number</b></td>
			             		<td><b>Loan Purpose</b> </td>
			             		<td><b>Specify other loan purpose</b></td>
			             	</tr>
			             	<tr>
			             		<td>{!! $transaction->propertyUse->a021_name!!}</td>
			             		<td> {!! $transaction->a116_unitsnumber!!} </td>
			             		<td> {!! $transaction->loanPurspose->a021_name!!}</td>
			             		<td> {!! $transaction->a116_loanpurposeother!!}</td>
			             	</tr>
             			</table>
             		</th>
             	</tr>
             	
             	
             	@if($transaction->a116_refinanceyearacquired > 0)
             	<tr id="refinanTitlte" >
	             	<td colspan="4">
	             		<table class="table">
             				<tr>
             					<td colspan="4">
             						<tr >
				             			<th colspan="4"><h4>Refinance Loan</h4></th>
					             	</tr>
						            <tr >
					             		<td width="80px"><b>Year acquired </b></td>
					             		<td width="120px"><b>Original cost</b></td>
					             		<td width="120px"><b>Refinance Purpose</b></td>
					             		<td width="120px"><b>Existing loan amount</b> </td>
					             	</tr>
				             		<tr>
							        	<td>{!! $transaction->a116_refinanceyearacquired!!}</td>
							        	<td>{!! App\Util::formatDecimalNumber($transaction->a116_refinancecost)!!}</td>
							        	<td>{!! $transaction->refinancePurpose->a021_name!!} </td>							        	
							        	<td>{!! App\Util::formatDecimalNumber($transaction->a116_refinanceliensexisting)!!}</td>
									</tr>
             					</td>
             				</tr>
             			</table>
             		</td>
             	</tr>
             	@endif
             	
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
				             	<th colspan="4" ><h4>Borrower Information</h4></th>
			             	</tr>
			             	<tr>
			             		<td width="100px" ><b>Name</b></td>
					            <td width="120px"><b>Mobile</b></td>
					            <td width="90px"> <b>DOB</b></td>
					            <td width="90px"><b>SSN</b></td>
					            <td width="90px"><b>Civil Status</b> </td>
				            </tr>
				            <tr>
			             		<td >{!! $transaction->borrower->a117_name!!} {!! $transaction->borrower->a117_lastname!!}</td>
			             		<td>{!!  phone_format( $transaction->borrower->a117_mobile, "US", 2)!!}  </td>
			             		<td>{!! App\Util::getStringFormat2($transaction->borrower->a117_dob)!!} </td>
			             		<td>{!!  $transaction->borrower->a117_ssn!!}</td>
			             		<td>{!!  App\Util::getCivilStatus()[$transaction->borrower->a117_civilstatus]!!}</td>
			             	</tr>
             			</table>
             		</th>
             	</tr>
             	
             	@if($transaction->a116_coborrowerid != "")
             	<tr>
             		<th colspan="4">
             			<table class="table">
             				<tr>
				             	<th colspan="4" ><h4>Coborrower Information</h4></th>
			             	</tr>
			             	<tr>
			             		<td width="100px" ><b>Name</b></td>
					            <td width="120px"><b>Mobile</b></td>
					            <td width="90px"><b> DOB</b></td>
					            <td width="90px"><b>SSN</b></td>
					            <td width="90px"><b>Civil Status</b> </td>
				            </tr>
				            <tr>
			             		<td >{!! $transaction->coborrower->a117_name!!} {!! $transaction->coborrower->a117_lastname!!}</td>
			             		<td>{!!  phone_format( $transaction->coborrower->a117_mobile, "US", 2)!!}  </td>
			             		<td>{!! App\Util::getStringFormat2($transaction->coborrower->a117_dob)!!} </td>
			             		<td>{!!  $transaction->coborrower->a117_ssn!!}</td>
			             		<td>{!!  App\Util::getCivilStatus()[$transaction->coborrower->a117_civilstatus]!!}</td>
			             	</tr>
             			</table>
             		</th>
             	</tr>
             	@endif
             	
             </table>
         
			
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2"> 
					<button class="btn-success btn" onclick="showConditions();">Conditions</button>
					
					@if( Session::get('active_user')['a104_roleid'] != 5)
						<button class="btn-success btn" onclick="location.href='{{ url('transaction/edit', $transaction->a116_id) }}'">Edit</button>
					@endif
					<?php                        	
						$urlImage = Session::get('return_page'); 
                       	if($urlImage == ""){ $urlImage = "transactions"; }
                    ?>
						<button class="btn-inverse btn" onclick="location.href=localhost + '{!! $urlImage !!}'">Back</button>
                </div>
			</div>
			
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	<div class="modal-dialog" style="width: 90%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Conditions</h4>
			</div>
			
			<div class="modal-body" id="modal-body">	
				
				@if( Session::get('active_user')['a104_roleid'] != 5)
				<div id="addnews" >				
				{!! Form::open(array('action' => 'TransactionConditionController@store', 'class' => 'form-horizontal', 'name' => 'conditionsf', 'id' => 'conditionsf')) !!}
				{!! Form::hidden('transactionid',  $transaction->a116_id, ['id' => 'transactionid']) !!}
				{!! Form::hidden('userid',  Session::get('active_user')['a102_id'] , ['id' => 'userid']) !!}
				<div class="form-group row">
					
					<div class="col-md-2">
					 {!! Form::select('documenttype', App\Util::getConditionType(), null, ['class'=> 'form-control', 'style' =>'width: auto;' ])!!}</td>
					</div>
					<div class="col-md-3">
	                	{!! Form::textarea('document', null,  ['id'=> 'document', 'class'=> 'form-control', 'placeholder' => 'Document', 'cols'=> '5', 'rows' => '2']) !!}
	                </div>
	                
	                <div class="col-md-3">                	
	                	{!! Form::textarea('comment', null,  ['id'=> 'comment', 'class'=> 'form-control', 'placeholder' => 'Description', 'cols'=> '5', 'rows' => '2']) !!}
	                </div>
	                
	               	<div class="col-md-2" > 
		            	{!!Form::select('assignedto', $associates, null, ['class'=> 'form-control', 'id' => 'assignedto'])!!}
		            </div>
		            
		            <div class="col-md-1" > 
		            	{!! Form::button('Add', ['id'=> 'newCondition', 'class'=> 'btn btn-warning  btn-flat', 'onclick'=> 'saveTransactionDocument();']) !!} <br/>
		            	{!! Form::button('Send Email', ['id'=> 'newCondition', 'class'=> 'btn btn-warning  btn-flat', 'onclick'=> 'sendConditionEmail();']) !!}
		            </div>
				</div>
				{!! Form::close() !!}
				</div>
				@endif
				
				
				{!! Form::open(array('action' => 'TransactionConditionController@update', 'name' => 'documentform' , 'id' => 'documentform' , 'class' => 'form-horizontal', "enctype" => "multipart/form-data")) !!}
				<div class="form-group row">
              		<br/><br/>
              		<h4 class="modal-title" id="myModalLabel">Conditions Requested</h4>
	               <table class="table table-striped table-bordered display" >
	               		<thead>
			                <tr>
			                    <th>Document</th>
			                    <th>Description</th>
			                    <th width="60px">File</th>                   
			                    <th>Comments</th>
			                    <th width="20px">Modified by</th>
			                    <th>Status</th>
			                </tr>
			            </thead>
			            <tbody id="conditiontable"></tbody>
	               </table>
	               
	               <!-- 
	                <div id="textFileID"></div>
	                
<script type="text/javascript" src="http://github.com/malsup/media/raw/master/jquery.media.js?v0.92"></script> 
<script type="text/javascript" src="http://jquery.malsup.com/jquery.metadata.js"></script>
 
<a id="media" class="media" href="http://localhost:8080/colanet/transaction/42-salidaExport.csv">PDF File</a> 
<a id="media" class="media {type: 'html'}" href="../">HTML File</a> 
         -->
	                
               </div> 
			</div> 
			
			<div class="modal-footer">
				<input type="submit" class="btn btn-default" value="Update">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>				
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

			
<script type="text/javascript">
	function showConditions()
	{
		$('#myModal').modal();
		getTransactionConditions({!!$transaction->a116_id !!});
	}

	function goBack(url)
	{
		window.location.href= localhot + url;
	}
	
	if({!!$showcondition!!} == 1)
	{
		showConditions();
	}
	
</script>

@endsection


