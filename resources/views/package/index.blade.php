
@extends('layouts.master')

@section('content')

	
<div class="right_col" role="main">
	
	<h3 class="blank1">Packages</h3>
		
	@if ( !$packages->count() )
        You have no packages
    @else

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
	
				<div class="x_content">
					{!!Form::open(array('action' => array('PackageController@destroy'))) !!}
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
							@foreach( $packages as $package )
							<tr>
								<td class="a-center ">
	                              <input type="checkbox" class="flat" name="ids[]" value="{{ $package->a02_id }}">
	                            </td>
								<td><a href="{{ url('package/edit', $package->a02_id) }}">{{$package->a02_name }} </a></td>
								<td>{{ $package->a02_description }}</td>
								<td>
									@if ( $package->a02_status == 1 ) 
										Active 
									@elseif ($package->a02_status == 2 ) 
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
     <br/><br/><br/>	<button class="btn-success btn" onclick="location.href='{{ url('package/create') }}'">Create</button>
	</div>
	<!-- /page content -->    
</div>
@endsection