
@extends('layouts.master')

@section('content')
    <h3 class="blank1">Appointment Locations</h3>
    @if ( !$locations->count() )
        You have no status
    @else
    
    @include('layouts.div-error')
   
	    <table id="example" class="table table-striped table-bordered display" >
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            
            	@foreach( $locations as $status )
                    <tr> 
						<?php $associateds = ""; ?>                    
                    	@foreach( $status->associates as $associate )
                    		<?php $associateds .= $associate->a102_id. ","; ?> 
                    	@endforeach
                        <td>
                        	<a href="#" onclick="editProspect( {{ $status->a016_id }}, '{{ $status->a016_name }}', {{ $status->a016_status }}, [ <?php echo $associateds; ?>])">{!! $status->a016_name !!}</a>
                        </td>     
                        <td>
                        	@if ( $status->a016_status == 1 )
						        Active
							@else
						        Inactive
						    @endif
						</td>
						<td>
							<!--  Security options -->
							<div class="dropdown">
								<a href="#" title="" class="btn btn-default" data-toggle="dropdown" aria-expanded="false">
									<i class="fa fa-cog icon_8"></i>
									<i class="fa fa-chevron-down icon_8"></i>
								<div class="ripple-wrapper"></div></a>
								<ul class="dropdown-menu pull-right">
									
									{!!Form::open(array('action' => array('AppointmentLocationController@destroy', $status->a016_id), 'method' => 'DELETE', 'id'=>'form'.$status->a016_id)) !!}
									<li>
										<a href="#" onclick="return confirmDelete('{{ $status->a016_name}}', {{ $status->a016_id}});" >
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
        @include('layouts.table')
    @endif
    
    <div class="col-sm-6">
		<button class="btn-inverse btn" onclick="createStatus();">Create</button>
	</div>
	
	
	<script>
		var teamId;
		
		function confirmDelete(team, id) {			
		    document.getElementById("teamName").innerHTML =team;
		    teamId = id;
		    $('#myModal').modal();
		}

		function createStatus() {	
			$("#appLocationId").val("");
		    $("#name").val("");
		    $("#status").val("");
		    $("#my-select").val("");
		    $('#newStatus').modal();
		}

		function sendSubmit() {	
			document.getElementById("form"+teamId).submit();
		}

		function editProspect(appLocationId, name, status, associates) 
		{		
			listaCitas.deselectAll();
		    $("#appLocationId").val(appLocationId);
		    $("#name").val(name);
		  	var arrayAssociated = document.getElementsByName("associated[]");
		    for (var i=0; i<associates.length;i++)
			{
		    	/*$('#my-select .sol-selection-container').
		    		find('input:checkbox[value='+associate.click()not([disable
		   	 $("#chk").trigger("change");', true).trigger('change', true);
*/
		    	
		   		for (var j=0; j<arrayAssociated.length;j++){
					if(arrayAssociated[j].value == associates[i])
						arrayAssociated[j].click();
		   		}
 	    	}	
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
				{!! Form::open(array('action' => 'AppointmentLocationController@store', 'class' => 'form-horizontal')) !!}
				 {!! Form::hidden('appLocationId', null, ['id'=> 'appLocationId']) !!}
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
	                        {!! Form::text('name', null,  ['id'=> 'name', 'class'=> 'form-control', 'placeholder' => 'Name']) !!}
	                    </div>
	                      
	                     <div class="col-sm-4">
	                        {!! Form::select('status', App\Util::getStatus(), null,  ['id'=> 'status', 'class'=> 'form-control']) !!}
	                    </div>
	                </div>
	                
	                <div class="form-group">
	                	 <div class="col-sm-8">
	                        {!!Form::select('associated[]', $associates, null, ['id' => 'my-select', 'multiple' => 'multiple'])!!}
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
 <script type="text/javascript">
 
 	$(document).ready( function() {
	  $('form').addClass( 'form-horizontal' );
	});

 	var listaCitas = $('#my-select').searchableOptionList( {
 	    texts: { searchplaceholder: 'Select members for this location' }
 	});
</script>
	
@endsection
