
@extends('layouts.master')

@section('content')

	
<div class="right_col" role="main">
	
		<h3 class="blank1">Users</h3>
		
		@if ( !$users->count() )
	        You have no users
	    @else

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
		
					<div class="x_content">
						{!!Form::open(array('action' => array('UserController@destroy'))) !!}
						<table id="example" class="table table-striped table-bordered">
							<thead>
								<tr>
									<td>
                              
                            		</td>
									<th>Name</th>
									<th>Username</th>
									<th>Phone</th>
									<th>Role</th>
									<th>Status</th>
								</tr>
							</thead>					
							<tbody>
								@foreach( $users as $user )
								<tr>
									<td class="a-center ">
		                              <input type="checkbox" class="flat" name="ids[]" value="{{ $user->a01_id }}">
		                            </td>
									<td><a href="{{ url('user/edit', $user->a01_id) }}">{{
											$user->a01_name }} {{ $user->a01_lastname }}</a></td>
									<td>{{ $user->a01_username }}</td>
									<td>{{ $user->a01_phone }}</td>
									<td>
										@if ( $user->a01_roleid == 1 ) 
											Admin 
										@elseif ($user->a01_roleid == 2 ) 
											Desk 
										@else 
											Stylist
										@endif
									</td>
									<td>
										@if ( $user->a01_status == 1 ) 
											Active 
										@elseif ($user->a01_status == 2 ) 
											Inactive 
										@else Inactive @endif
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
	     <br/><br/><br/>	<button class="btn-success btn" onclick="location.href='{{ url('user/create') }}'">Create</button>
		</div>
	<!-- /page content -->
    
</div>
@endsection