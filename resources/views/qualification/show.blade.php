
@extends('layouts.master')

@section('content')
    
    <h3 class="blank1">Deal Center</h3>
    
	<style>
		.table>tbody>tr>td {
			padding: 2px 8px 0px 8px !important;
			font-size: 13px;
		}
		
		.table .table {
			background-color: transparent;
		}
		
		.table .table>tbody>tr>td {
			font-weight: lighter;			
		}
		
		h4 {
			margin-bottom: -5px;
			margin-left: -10px
		}
	</style>

	<table class="table table-bordered " style="width: 60%">
		<tr>
			<th colspan="4">
				<table class="table">
					<tr>
						<td><b>Member</b></td>
						<td><b>Assigned to</b></td>
						<td >Status </td>
						<td><b>Created by</b></td>
						<td><b>Creation date</b></td>
					</tr>
					<tr>
						<td>{!! $qualification->associate->a102_username!!} </td>
						<td>
							@if($qualification->assignedTo)
							{!! $qualification->assignedTo->a102_username!!}
							@endif 
						</td>
						<td>
							{!! App\Util::getQualificationStatus()[$qualification->a119_status] !!}
						</td>
						<td>{!! $qualification->createdBy->a102_username!!} </td>
						<td>{!!
							App\Util::getStringFormat2($qualification->a119_creationdate)!!}</td>
					</tr>
				</table>
			</th>
		</tr>
	
		<tr>
		<th colspan="4">
			<table class="table" >
				<tr>
					<th colspan="4"><h4>Type of Mortage and purpose of Loan</h4></th>
				</tr>
				<tr>
					<td width="200px"><b>Applied for</b></td>
					<td><b>Loan Purpose</b> </td>
					<td width="200px"><b>Specify other loan purpose</b></td>
				</tr>
				<tr>
					<td> {!! $qualification->appliedFor->a021_name!!}</td>
					<td> {!! $qualification->loanPurspose->a021_name!!}</td>
					<td> {!! $qualification->a119_loanpurposeother!!}</td>
				</tr>
				
				<tr>
					<td><b>Property use</b></td>
					<td><b>Units number</b></td>
				</tr>
				<tr>
					<td>{!! $qualification->propertyUse->a021_name!!}</td>
			        <td>{!! $qualification->a119_unitsnumber!!} </td>
				</tr>

				<tr>
					<th colspan="3"><br/><h4>Property information</h4></th>
				</tr>
				<tr>
					<td colspan="4"><b>Address</b></td>
				</tr>
				
				<tr>
					<td  colspan="4"> {!!
						$qualification->a119_address!!}, {!!
						$qualification->city->a003_name!!}, {!!
						$qualification->state->a002_name!!}, {!!
						$qualification->a119_zipcode!!}
					</td>
				</tr>
				
				<tr>
					<th colspan="4"><h4><br/>Borrower Information</h4></th>
				</tr>
				<tr>
					<td width="100px"><b>Name</b></td>
					<td width="120px"><b>Mobile</b></td>
					<td width="90px"><b>DOB</b></td>					
				</tr>
				<tr>
					<td>{!! $qualification->borrower->a117_name!!} {!! $qualification->borrower->a117_lastname!!}</td>
					<td>{!! phone_format( $qualification->borrower->a117_mobile, "US", 2)!!}</td>
					<td>{!! App\Util::getStringFormat2($qualification->borrower->a117_dob)!!} </td>
				</tr>
				
				<tr>
					<td width="90px"><b>SSN</b></td>
					<td width="100px"><b>Email</b></td>
					<td width="90px"><b>Civil Status</b></td>
				</tr>
				<tr>
					<td>{!! $qualification->borrower->a117_ssn!!}</td>
					<td>{!! $qualification->borrower->a117_email!!}</td>
					<td>{!! App\Util::getCivilStatus()[$qualification->borrower->a117_civilstatus]!!}</td>
				</tr>
				
				<tr>
					<td><b>Current Address</b></td>
					<td><b>Time living at this place:</b> </td>
					<td> @if($qualification->borrower->a117_livingtime < 25)
						<b>Previous address</b>
						@endif
					</td>
				</tr>
				
				<tr>
					<td>
						@if ( $qualification->borrower->a117_address != null)
                     		{!! $qualification->borrower->a117_address !!}
                     	@endif 
                     	@if ( $qualification->borrower->city != null)
                     	 {!!  $qualification->borrower->city->a003_name !!}
                     	@endif 
                     	@if ( $qualification->borrower->state != null)
	                     	  {!!  $qualification->borrower->state->a002_name !!}
                     	@endif 
                     	@if ( $qualification->borrower->a117_zipcode != null)
                     		 {!! $qualification->borrower->a117_zipcode!!}
                     	@endif
                    </td>
                    <td > {!!$qualification->borrower->a117_livingtime!!} months</td>
					<td> {!! $qualification->borrower->a117_previousaddress!!}</td>	
				</tr>
				
				<tr>
					<th colspan="4"><span style="font-size: 14px; margin-left: -10px"><b>Employee Information</b></span></th>
				</tr>
				<tr>
					<td  ><b>Employeer</b></td>
					<td ><b>Position</b></td>
					<td ><b>Basic salary </b></td>
				</tr>
				
				<tr>
					<td>
						{!! $qualification->borrower->a117_employername!!} 
						@if($qualification->borrower->a117_selfemployee == 1)
							<br/><span style="color: red">  (Self-Employed)</span>
						@endif
					</td>
					<td>{!! $qualification->borrower->a117_employeeposition !!} </td>
					<td>${!! App\Util::formatNumber(  $qualification->borrower->a117_employeebasicsalary )!!} </td>
				</tr>
				
				<tr>
					<td  ><b>Telephone</b></td>
					<td ><b>Time at this job</b></td>
					<td >@if($qualification->borrower->a117_employeeothercompansation > 0)
							<b>Oher Compensation type </b>
						@endif
					</td>
				</tr>
				
				<tr>
					<td  >
						@if($qualification->borrower->a117_employeephone != "")
							{!! phone_format( $qualification->borrower->a117_employeephone, "US",
							2)!!}
						@endif
					</td>
					<td >{!!  $qualification->borrower->a117_employeeduration!!} months</td>
					<td>
						@if($qualification->borrower->a117_employeeothercompansation > 0)
							${!! App\Util::formatNumber(  $qualification->borrower->a117_employeeothercompansation )!!}  
							{!!App\Util::getCompensationType()[$qualification->borrower->a117_employeeothercompansantiontype]!!}
						@endif
					</td>
				</tr>
				
				
				@if($qualification->a119_coborrowerid != "")
				<th colspan="4">
					<table class="table" >
						<tr>
							<th colspan="4"><h4>Coborrower Information</h4></th>
						</tr>
						<tr>
							<td width="100px"><b>Name</b></td>
							<td width="120px"><b>Mobile</b></td>
							<td width="90px"><b>DOB</b></td>					
						</tr>
						<tr>
							<td>{!! $qualification->coborrower->a117_name!!} {!! $qualification->coborrower->a117_lastname!!}</td>
							<td>{!! phone_format( $qualification->coborrower->a117_mobile, "US", 2)!!}</td>
							<td>{!! App\Util::getStringFormat2($qualification->coborrower->a117_dob)!!} </td>
						</tr>
						
						<tr>
							<td width="90px"><b>SSN</b></td>
							<td width="100px"><b>Email</b></td>
							<td width="90px"><b>Civil Status</b></td>
						</tr>
						<tr>
							<td>{!! $qualification->coborrower->a117_ssn!!}</td>
							<td>{!! $qualification->coborrower->a117_email!!}</td>
							<td>{!! App\Util::getCivilStatus()[$qualification->coborrower->a117_civilstatus]!!}</td>
						</tr>
						
						<tr>
							<th colspan="3"><span style="font-size: 14px;"><b>Employee Information</b></span></th>
						</tr>
						<tr>
							<td  ><b>Employeer</b></td>
							<td ><b>Position</b></td>
							<td ><b>Basic salary </b></td>
						</tr>
						
						<tr>
							<td>{!! $qualification->coborrower->a117_employername!!} 
							@if($qualification->coborrower->a117_selfemployee == 1)
								<br/><span style="color: red">  (Self-Employed)</span>
							@endif
								
							</td>
							<td>{!! $qualification->coborrower->a117_employeeposition !!} </td>
							<td>$  {!! App\Util::formatNumber(  $qualification->coborrower->a117_employeebasicsalary )!!} </td>
						</tr>
						
						<tr>
							<td ><b>Telephone</b></td>
							<td ><b>Months at this job</b></td>
							<td ><b>Oher Compensation type </b></td>
						</tr>
						
						<tr>
							<td>
								@if($qualification->coborrower->a117_employeephone != "")
									{!! phone_format( $qualification->coborrower->a117_employeephone, "US",
									2)!!}
								@endif
							</td>
							<td >{!!  $qualification->coborrower->a117_employeeduration!!}</td>
							<td>
								@if($qualification->coborrower->a117_employeeothercompansation > 0)
									$  {!! App\Util::formatNumber(  $qualification->coborrower->a117_employeeothercompansation )!!}  
									{!!App\Util::getCompensationType()[$qualification->coborrower->a117_employeeothercompansantiontype]!!}
								@endif
							</td>
						</tr>
						
						<tr>
							<td colspan="3" ><b>Address</b></td>
						</tr>
						
						<tr>
							<td colspan="3">
								@if ( $qualification->a117_employeeaddress != null)
		                     		{!!Form::label( $qualification->coborrower->a117_employeeaddress, null, array ('class' => 'control-label'))!!}
		                     	@endif 
		                     	@if ( $qualification->coborrower->city != null)
		                     	 {!!Form::label( $qualification->coborrower->city->a003_name, null, array ('class' => 'control-label'))!!}
		                     	@endif 
		                     	@if ( $qualification->coborrower->state != null)
			                     	  {!!Form::label( $qualification->coborrower->state->a002_name, null, array ('class' => 'control-label'))!!}
		                     	@endif 
		                     	@if ( $qualification->a117_employeezipcode != null)
		                     		 {!!Form::label( $qualification->a117_employeezipcode, null, array ('class' => 'control-label'))!!}
		                     	@endif
		                    </td>
						</tr>
					</table>
				@endif
			</table>
		</th>
		<tr>
			<th colspan="4">
				<table class="table">
					<tr>
						<td width="50%"><b><h4>Borrower comments</h4></b></td>
					</tr>
					<tr>	
						<td width="50%">{!! $qualification->a119_commentsborrower!!} </td>
					</tr>
					<tr>
						<td width="50%"><br/><b><h4>Case comments</h4> </b></td>
					</tr>
					<tr>
						<td width="50%">{!! $qualification->a119_commentscase!!} </td>
					</tr>
					<tr>
						<th colspan="4"><br/><h4><br/>Lender Exclusive Use</h4></th>
					</tr>
					<tr>
						<td  colspan="4"> {!! $qualification->a119_feedback!!}<br/><br/><br/> </td>
					</tr>
				</table>
			</th>
		</tr>
	</tr>
</table>


<script>
	$(document).ready(function () {
        $("#openPopUp").click(function () {
            var myWindow=window.open ("{{ url('prospect/show', $qualification->borrower->a117_prospectid) }}",",","menubar=1,resizable=1,width=800,height=500");
        });
    });
</script>

<div class="row">
	<div class="col-sm-8 col-sm-offset-2"> 
	<button class="btn-success btn" onclick="location.href='{{ url('qualification/edit', $qualification->a119_id) }}'">Edit</button>
	
	<button class="btn-info btn" id="openPopUp" >Prospect Info</button>
	
	
	{!! Form::button('Back',
		['class'=> 'btn-default btn', 'onclick'=>
		'javascript:history.back();']) !!}</div>
</div>

@endsection


