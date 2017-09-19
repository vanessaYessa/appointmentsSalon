
@extends('layouts.master')

@section('content')

	
<div class="right_col" role="main">
	
	<h3 class="blank1">Customer</h3>
	
	<div class="row">
		{!! Form::open(array('action' => 'ClientController@index', 'class' => 'form-inline')) !!}
		
		<div class="x_panel">
			<div class="col-md-2 ">
			<label style="font-size: 18px">Name:</label> 
				{!! Form::text('namef', $filter[0], ['class'=> 'form-control ', 'id' => 'name', 'placeholder' => 'Customer name' ]) !!}
            </div>
            
            <div class="col-xs-1 "></div>
            
			<div class="col-md-2 ">
				<label style="font-size: 18px">Number:</label> 
				{!! Form::text('phonef', $filter[1], ['class'=> 'form-control ', 'id' => 'phone', 'placeholder' => 'Search by Mobile' ]) !!}
			</div>
			
			<div class="col-xs-1 "></div>
			
			<div class="col-md-2 ">
				<label style="font-size: 18px">Stylist:</label> 
				{!! Form::select('stylist', $users, $filter[2], ['class'=> 'form-control']) !!}
			</div>
			
			<div class="col-md-4" style="text-align: center;">
				<br/>{!! Form::submit('Search', ['class'=> 'btn btn-primary']) !!} &nbsp;&nbsp;&nbsp;&nbsp;
				<button class="btn-inverse btn" onclick="location.href='{{ url('client/create') }}'; return false;">Create</button>
			</div>		
		</div>
		{!! Form::close() !!} 
	</div>
		
	@if ( !$clients->count() )
        You have no clients
    @else
	<div class="row">
			
		<div class="x_panel">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
		
					<div class="x_content">
						{!!Form::open(array('action' => array('ClientController@destroy'))) !!}
						<table id="example" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="10px"></th>
									<th>Name</th>
									<th>Mobile</th>
									<th>BOD</th>
									<th>Email</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach( $clients as $client )
								<tr>
									<td class="a-center ">
		                              <input type="checkbox" class="flat" name="ids[]" value="{{ $client->a05_id }}">
		                            </td>
									<td><a href="{{ url('client/edit', $client->a05_id) }}">{{
											$client->a05_name }} {{ $client->a05_lastname }}</a></td>
									<td>
										{{ phone_format($client->a05_mobile, "US", 2) }} 
										
										 @if ( $client->a05_phone )
				                        	  <br/> {{ phone_format($client->a05_phone, "US", 2)}}
				                        @endif 
									</td>
									<td> @if ( $client->a05_dob ) {{ App\Util::getBOD($client->a05_dob) }} @endif </td> 
									<td>
										{{ $client->a05_email }}
									</td>
									<td>
										@if ( $client->a05_status == 1 ) 
											Active 
										@elseif ($client->a05_status == 2 ) 
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
		     <br/><br/><br/>	<button class="btn-inverse btn" onclick="location.href='{{ url('client/create') }}'">Create</button>
			</div>
		</div>
	</div>	
	
	<!--  Masked Input -->
	<script src="{{ asset ('js/jquery.maskedinput.min.js')}}"></script>
	<script type="text/javascript">
		jQuery(function($){
			$("#phone").mask("(999) 999-9999");
	  
		});
	</script>	
	
</div>
@endsection