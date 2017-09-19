
@extends('layouts.master')

@section('content')

	
<div class="right_col" role="main">
	
	<h3 class="blank1">Services</h3>
		
	@if ( !$services->count() )
        You have no services
    @else

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
	
				<div class="x_content">
					{!!Form::open(array('action' => array('ServiceController@destroy'))) !!}
					<table id="example" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="10px"></th>
								<th>Name</th>
								<th>Description</th>
								<th>Status</th>
							</tr>
						</thead>
	
	
						<tbody>
							@foreach( $services as $service )
							<tr>
								<td class="a-center ">
	                              <input type="checkbox" class="flat" name="ids[]" value="{{ $service->a02_id }}">
	                            </td>
								<td><a href="{{ url('service/edit', $service->a02_id) }}">{{$service->a02_name }} </a></td>
								<td>{{ $service->a02_description }}</td>
								<td>
									@if ( $service->a02_status == 1 ) 
										Active 
									@elseif ($service->a02_status == 2 ) 
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
     <br/><br/><br/>	<button class="btn-success btn" onclick="location.href='{{ url('service/create') }}'">Create</button>
	</div>
	<!-- /page content -->    
</div>
@endsection