
@extends('layouts.master')

@section('content')
    <h3 class="blank1">Element Transaction</h3>
    @if ( !$elementTypes->count() )
        You have no transaction elements
    @else
    
    @include('layouts.div-error')
   
	    <table id="example" class="table table-striped table-bordered display" >
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            	@foreach( $elementTypes as $elementType ) 
                    <tr> 
                        <td>
                        	@if ( $elementType->a021_elementtype == 1 )
						        Applied for
							@elseif ( $elementType->a021_elementtype == 2 )
							    Amortization Type
							@elseif ( $elementType->a021_elementtype == 3 )
						        Purpose of Loan
							@elseif ( $elementType->a021_elementtype == 4 )
						        Property will be
							@elseif ( $elementType->a021_elementtype == 5 )
						        Purpose of refinance
							@endif
						</td>
						
						<td>
                        	<a href="#" onclick="editEle( {{ $elementType->a021_id }}, '{{ $elementType->a021_name }}', {{ $elementType->a021_elementtype }}, {{ $elementType->a021_status }})">{!! $elementType->a021_name !!}</a>
                        </td>     
                        
                        
                        <td>
                        	@if ( $elementType->a021_status == 1 )
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
									
									{!!Form::open(array('action' => array('TransactionElementController@destroy', $elementType->a021_id), 'method' => 'DELETE', 'id'=>'form'.$elementType->a021_id)) !!}
									<li>
										<a href="#" onclick="return confirmDelete('{{ $elementType->a021_name}}', {{ $elementType->a021_id}});" >
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
    
    <div class="col-sm-4">
		<button class="btn-inverse btn" onclick="createEl();">Create</button>
	</div>
	
	
	<script>
		var elementTypeId;
		
		function confirmDelete(team, id) {			
		    document.getElementById("teamName").innerHTML =team;
		    elementTypeId = id;
		    $('#myModal').modal();
		}

		function createEl() {	
			$("#elementId").val("");
		    $("#name").val("");
		    $("#status").val("");
		    $("#elementType").val("");
		    $('#newElement').modal('show');
		}

		function sendSubmit() {	
			document.getElementById("form"+elementTypeId).submit();
		}

		function editEle(elementId, name, elementTypeId, status) 
		{			
		    $("#elementId").val(elementId);
		    $("#name").val(name);
		    $("#status").val(status);
		    $("#elementType").val(elementTypeId);
		    $('#newElement').modal();
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
		
		@if($errors->all())
		    <p class="alert alert-danger">
	        	@foreach($errors->all() as $error)
	                {{$error}}<br/>
	            @endforeach
	        </p>
	        
	        <script type="text/javascript">
				 $(window).load(function(){
			        $('#newProspect').modal('show');
			    });
			 </script>
		@endif
	</div>
	<!-- /.modal -->
	
	
	
	 <!-- Express Prospect Modal -->
	<div class="modal fade" id="newElement" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">	
		<div class="modal-dialog">
			<div class="modal-content">
				{!! Form::open(array('action' => 'TransactionElementController@store', 'class' => 'form-horizontal')) !!}
				 {!! Form::hidden('elementId', null, ['id'=> 'elementId']) !!}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">X</button>
					<h5 class="modal-title" >
						<i class="lnr lnr-cog"></i> New Element Transaction
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
	                    <div class="col-sm-4">
	                        {!! Form::text('name', null,  ['id'=> 'name', 'class'=> 'form-control', 'placeholder' => 'Name']) !!}
	                    </div>
	                    
	                    <div class="col-sm-4">
	                        {!! Form::select('elementType', App\Util::getTransactionElementsArray(), null,  ['id'=> 'elementType', 'class'=> 'form-control']) !!}
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
	
@endsection
