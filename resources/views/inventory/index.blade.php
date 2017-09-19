
@extends('layouts.master')

@section('content')

	
<div class="right_col" role="main">
	
	<h3 class="blank1">Inventory</h3>
		 
	@if ( !$inventories->count() )
        You have no inventory
    @else

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
	
				<div class="x_content">
					{!!Form::open(array('action' => array('InventoryController@destroy'))) !!}
					<table id="example" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="10px"></th>
								<th>Name</th>
								<th>Quantity</th>
								<th>Status</th>
							</tr>
						</thead>
	
	
						<tbody>
							@foreach( $inventories as $inventory )
							<tr>
								<td class="a-center ">
	                              <input type="checkbox" class="flat" name="ids[]" value="{{ $inventory->a15_id }}">
	                            </td>
								<td><a href="{{ url('inventory/edit', $inventory->a15_id) }}">{{$inventory->a15_name }} </a></td>
								<td>{{ $inventory->a15_quantity }}</td>
								<td>
									@if ( $inventory->a15_status == 1 ) 
										Active 
									@elseif ($inventory->a15_status == 2 ) 
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
     <br/><br/><br/>	<button class="btn-success btn" onclick="location.href='{{ url('inventory/create') }}'">Create</button>
	</div>
	<!-- /page content -->    
</div>
@endsection