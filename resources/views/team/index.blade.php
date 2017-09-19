
@extends('layouts.master')

@section('content')
    <h3 class="blank1">Teams</h3>
    @if ( !$teams->count() )
        You have no teams
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
            	@foreach( $teams as $team )
                    <tr> 
                        <td>
                        	<a href="{{ url('team/show', $team->a101_id) }}">{{ $team->a101_name }}</a>
                        </td>     
                        <td>
                        	@if ( $team->a101_status == 1 )
						        Active
						    @elseif ( $team->a101_status == 2 )
								Inactive
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
									
									<li class="divider"></li>
									{!!Form::open(array('action' => array('TeamController@destroy', $team->a101_id), 'method' => 'DELETE', 'id'=>'form'.$team->a101_id)) !!}
									<li style="margin-left: 20px">
										<a href="#" onclick="return confirmDelete('{{ $team->a101_name}}', {{ $team->a101_id}});" class="font-red" title="">
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
		<button class="btn-inverse btn" onclick="location.href='{{ url('team/create') }}'">Create</button>
	</div>
	
	
	<script>
		var teamId;
		
		function confirmDelete(team, id) {			
		    document.getElementById("teamName").innerHTML =team;
		    teamId = id;
		    $('#myModal').modal();
		}

		function sendSubmit() {	
			document.getElementById("form"+teamId).submit();
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
	
@endsection
