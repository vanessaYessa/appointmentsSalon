
@extends('layouts.master')

@section('content')
    <h3 class="blank1">Transaction Status</h3>
    @if ( !$status->count() )
        You have no status
    @else
    
    @include('layouts.div-error')
   
	    <table id="example" class="table table-striped table-bordered display" >
            <thead>
                <tr>
                	<th>Code</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            	@foreach( $status as $status )
                    <tr> 
                    	<td >{{ $status->a022_code }}</td>
                        <td>
                        	<a href="#" onclick='editTransaction(  "{{ $status->a022_name }}", "{{ $status->a022_default }}",  "{{ $status->a022_description }}", "{{ $status->a022_code }}", {{ $status->a022_status }})'>{{ $status->a022_name }}</a>
                        	
                        	@if ( $status->a022_default == 1 )
						       <i class="fa fa-star" style="color:rgb(139, 195, 74)"></i>
							@endif
                        	
                        </td>     
                        <td width="45%">{{ $status->a022_description }}</td>
                        <td>
                        	@if ( $status->a022_status == 1 )
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
									
									{!!Form::open(array('action' => array('TransactionStatusController@destroy', $status->a022_code), 'method' => 'DELETE', 'id'=>'form'.$status->a022_code)) !!}
									<li>
										<a href="#" onclick="return confirmDelete('{{ $status->a022_name}}', {{ $status->a022_code}});" >
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
		<button class="btn-inverse btn" onclick="createStatus();">Create</button>
	</div>
	
	
	<script>
		var teamId;
		
		function confirmDelete(team, id) {			
		    document.getElementById("statusName").innerHTML =team;
		    teamId = id;
		    $('#myModal').modal();
		}

		function createStatus() {	
			$("#code").val("");
			$("#defaultv").val("");
			$("#name").val("");
		    $("#status").val("");
		    $("#description").val("");
		    $('#newStatus').modal();
		}

		function sendSubmit() {	
			document.getElementById("form"+teamId).submit();
		}

		function editTransaction( name, defaultv, description, code, status) 
		{			
			$("#defaultv").val(defaultv);
		    $("#name").val(name);
		    $("#status").val(status);
		    $("#code").val(code);
		    $("#description").val(description);
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
						Are you sure you want to delete <span id="statusName"></span></b>
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
	
	
	
	 <!-- Express Transaction Modal -->
	<div class="modal fade" id="newStatus" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				{!! Form::open(array('action' => 'TransactionStatusController@store', 'class' => 'form-horizontal')) !!}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">X</button>
					<h5 class="modal-title" >
						<i class="lnr lnr-cog"></i> New Transaction Status
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
	                    
	                   <div class="col-sm-4">
	                        {!! Form::text('code', null,  ['id'=> 'code', 'class'=> 'form-control', 'placeholder' => 'Code']) !!}
	                    </div>
	                    
	                     <div class="col-sm-8">
	                        {!! Form::text('name', null,  ['id'=> 'name', 'class'=> 'form-control', 'placeholder' => 'Name']) !!}
	                    </div>
	                 </div>
	                 
	                 <div class="form-group">    
	                 	<div class="col-sm-12"> 
	                        {!! Form::textarea('description', null,  ['id' => 'description', 'class'=> 'form-control', 'placeholder' => 'Description', 'rows' => '5']) !!}
	                    </div>
	                 </div>  
	                 
	                 <div class="form-group">    
	                     <div class="col-sm-6">
	                        {!! Form::select('defaultv', $defaultValue, null,  ['id'=> 'defaulv', 'class'=> 'form-control']) !!}
	                    </div>
	                    
	                     <div class="col-sm-6">
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
	<!-- /.Express Transaction Modal -->
	
@endsection
