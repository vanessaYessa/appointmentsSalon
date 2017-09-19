 @extends('layouts.master') 
 
 @section('content')


<?php
use Carbon\Carbon;
?>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Follow Up</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<!-- start form for validation -->						 
						 {!! Form::open(array('action' => 'FollowUpController@index', 'class' => 'form-horizontal', 'novalidate')) !!} 
							{!! Form::hidden('followupid',  null, ['id' => 'followupid']) !!}
							<div class="item form-group ">	
							<label for="name">Name:</label> 
							 {!! Form::text('name', null,  ['data-validate-lengthRange' =>"6", 'class'=> 'form-control', 'id'=> 'name', 'required']) !!}
							 </div>
							 
							 
							 <div class="item form-group ">	
							<label for="name">Name:</label> 
							 {!! Form::text('phone', null,  ['data-validate-lengthRange' =>"6", 'class'=> 'form-control', 'id'=> 'name', 'required']) !!}
							 </div>
						{!! Form::close() !!}
					</div>
					
					<div class="x_content">
						{!!Form::open(array('action' => array('FollowUpController@destroy'))) !!}
						<table id="example" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="10px"></th>
									<th>Name</th>
									<th>Last follow up</th>
									<th width="50%">Comments</th>
									<th>Next Follow up</th>
								</tr>
							</thead>
							<tbody>
						    	@for ($i = 0; $i < count($followups); $i++)
						    	<?php 
					            	$followup = $followups[$i];   
					            	
					            	$bgcolor = "";
					            	$end = Carbon::parse($followup->a05_followupdate);
					            	$now = Carbon::now();
					            	$datediff = $end->diffInDays($now);
					            	
					            	if ( $datediff == 0 )
				            			$bgcolor = "";
				            		else if (  $datediff > 0 && $datediff <= 2 )
				            			$bgcolor = "#ffff9b";
				            		else if ($datediff >= 3  )
				            			$bgcolor = "#f1a9ab";
					        	?>
					        	
				        	        <tr style="background-color: {!! $bgcolor; !!} !important">
				        	        	<td></td> 				                        
				                       	<td>
				                       		<a href="{{ url('client/edit', $followup->client->a05_id) }}">
				                       			 {{  $followup->client->a05_name }} {{  $followup->client->a05_lastname }}
					                       		<br/>
					                       		{{  phone_format($followup->client->a05_mobile, 'US', 2)}}
				                       		</a>
				                       	</td>
				                       	<td> {{  App\Util::getStringFormat2($followup->a12_date) }} </td>
				                       	<td> {{  $followup->a12_comments }}</td>
				                       	<td>  {{  App\Util::getStringFormat2($followup->client->a05_followupdate) }} </td>
				                       	
				                    </tr>
				                @endfor
									</tbody>
						</table>
						<br>
					<input type="submit" class="btn-inverse btn" value="Delete">
					
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
		
			@include('layouts.scripts')
			@include('layouts.table')
		<div>
	     
		</div>
	<!-- /page content -->
    
</div>
@endsection