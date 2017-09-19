
@extends('layouts.master')

@section('content')


	
<div class="right_col" role="main">
	
	<h3 class="blank1">Appointment Status</h3>
		
	@if ( !$statuslist->count() )
        You have no calendar status
    @else

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
	
				<div class="x_content">
					{!!Form::open(array('action' => array('UserController@destroy'))) !!}
					<table id="example" class="table table-striped table-bordered display" >
		            <thead>
		                <tr>
		                    <th>Name</th>
		                    <th>Color</th>
		                    <th>Status</th>
		                    <th></th>
		                </tr>
		            </thead>
		            <tbody>
		            
		            	@foreach( $statuslist as $status )
		                    <tr> 
		                        <td>
		                        	<a href="#" onclick="editProspect( {{ $status->a09_id }}, '{{ $status->a09_name }}', {{ $status->a09_status }}, '{{ $status->a09_color}}')">{!! $status->a09_name !!}</a>
		                        </td>  
		                        <td><div style="background-color:{{ $status->a09_color}}; text-align:center" >{{ $status->a09_color}} </div></td>
		                        <td>
		                        	<?php echo App\Util::getStatus()[$status->a09_status]; ?>
								</td>
								<td>
									<!--  Security options -->
									<div class="dropdown">
										<a href="#" title="" class="btn btn-default" data-toggle="dropdown" aria-expanded="false">
											<i class="fa fa-cog icon_8"></i>
											<i class="fa fa-chevron-down icon_8"></i>
										<div class="ripple-wrapper"></div></a>
										<ul class="dropdown-menu pull-right">
											
											{!!Form::open(array('action' => array('AppointmentStatusController@destroy', $status->a09_id), 'method' => 'DELETE', 'id'=>'form'.$status->a09_id)) !!}
											<li>
												<a href="#" onclick="return confirmDelete('{{ $status->a09_name}}', {{ $status->a09_id}});" >
													<i class="fa fa-times" ></i>
													Delete
												</a>
											</li>
											{!! Form::close() !!}
										</ul>
									</div> <!-- ./Security options -->
								</td>
		                    </tr>
		                @endforeach
		            </tbody>
		        </table>
					<br>
					<input type="submit" class="btn-inverse btn" value="Delete">
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	
		@include('layouts.scripts')
		@include('layouts.table')
	@endif
	
	<div>
     <br/><br/><br/>
     <button class="btn-success btn" onclick="createStatus();">Create</button>
	</div>
<!-- /page content -->

	
	<script>
		var teamId;
		
		function confirmDelete(team, id) {			
		    document.getElementById("teamName").innerHTML =team;
		    teamId = id;
		    $('#myModal').modal();
		}

		function createStatus() {	
			$("#appStatusId").val("");
		    $("#name").val("");
		    $("#status").val("");
		    $("#color").val("");
		    $('#newStatus').modal();
		}

		function sendSubmit() {	
			document.getElementById("form"+teamId).submit();
		}

		function editProspect(appStatusId, name, status, color) 
		{		
			$("#appStatusId").val(appStatusId);
			$("#color").val(color);
			colorStatus.minicolors('defaultValue', color);
		    $("#name").val(name);
		    $("#status").val(status);
		  	$('#newStatus').modal();
		}
		
	</script>
	
	<!-- Confirm delete team -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">X</button>
					<h5 class="modal-title" id="myModalLabel">
						<b><span style="color: red;" class="glyphicon glyphicon-warning-sign">
						</span>  &nbsp;
						Are you sure you want to delete <span id="teamName"></span></b>
					</h5>
				</div>
				<div class="modal-footer">
					<div id="delmodelcontainer" style="float: right">
						<div id="yes" style="float: left; padding-right: 10px">
						{!!Form::submit('Yes, delete', array('class' => 'btn btn-primary', 'onclick' => 'sendSubmit();'))!!} 
						</div>
						<div id="no" style="float: left;">
							<button type="button" class="btn btn-defualt" data-dismiss="modal">No</button>
						</div>
					</div>
					<!-- end delmodelcontainer -->
	
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
	
	
	 <!-- Express Prospect Modal -->
	<div class="modal fade" id="newStatus" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				{!! Form::open(array('action' => 'AppointmentStatusController@store', 'class' => 'form-horizontal')) !!}
				 {!! Form::hidden('appStatusId', null, ['id'=> 'appStatusId']) !!}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">X</button>
					<h5 class="modal-title" >
						<i class="lnr lnr-cog"></i> New Appoitment Location
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
	                    <div class="col-sm-4">
	                        {!! Form::text('name', null, ['id'=> 'name', 'class'=> 'form-control', 'placeholder' => 'Name']) !!}
	                    </div>
	                    
		                <div class="col-sm-4">
	                       {!! Form::text('color', null, ['id'=> 'color', 'class'=> 'minicolors-input form-control', 'placeholder' => 'Color']) !!}
	                    </div>
	                
	                <div class="col-sm-4">
	                        {!! Form::select('status', App\Util::getStatus(), null,  ['id'=> 'status', 'class'=> 'form-control']) !!}
	                    </div>
	                </div>
	                
	                
				</div>
				<div class="modal-footer">
					<div id="delmodelcontainer" style="float: right">
						<div id="yes" style="float: left; padding-right: 10px">
						{!!Form::submit('Save', array('class' => 'btn btn-primary'))!!} 
						</div>
						<div id="no" style="float: left;">
							<button type="button" class="btn btn-defualt" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.Express Prospect Modal -->
	
	
 <style>
	.sol-selected-display-item { display: inline-block;}
</style>
 <link rel="stylesheet" href="{{ asset ('css/sol.css')}}" type='text/css' />
 <script src="{{ asset ('js/sol.js')}}"></script>
 
 
 <link rel="stylesheet" href="{{ asset ('js/jquery.minicolors.css')}}" type='text/css' />
 <script src="{{ asset ('js/jquery.minicolors.js')}}"></script>
 <script type="text/javascript">
 
 	$(document).ready( function() {
	  $('form').addClass( 'form-horizontal' );

	  colorStatus = $('#color').minicolors({
		    changeDelay: 200,
		    letterCase: 'uppercase',
		    theme: 'bootstrap'
		});
	});
</script>
    
</div>
@endsection