
@extends('layouts.master')

@section('content')

	
<div class="right_col" role="main">
	
		<h3 class="blank1">Sales</h3>
		
		@if ( !$sales->count() )
	        You have no sales
	    @else

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
		
					<div class="x_content">
						{!!Form::open(array('action' => array('SaleController@destroy'))) !!}
						<table id="example" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="10px"></th>
									<th>Name</th>
									<th>Date</th>
									<th>Volume Sale</th>
									<th>Status</th>
								</tr>
							</thead>
		
		
							<tbody>
								@foreach( $sales as $sale )
								<tr>
									<td class="a-center ">
		                              <input type="checkbox" class="flat" name="ids[]" value="{{ $sale->a07_id }}">
		                            </td> 
									<td><a href="{{ url('sale/show', $sale->a07_id) }}">
											{{ $sale->client->a05_name }} {{ $sale->client->a05_lastname }} 
											<br/>{{ phone_format($sale->client->a05_mobile, 'US', 2)}}</a>
									</td>
									<td> {{ $sale->a07_date }} </td>
																		
									<td>
										${{ $sale->a07_totalvalue }}
									</td>
									<td>
										{{ App\Util::getInvoiceStatus()[$sale->a07_status] }}
									</td>
								</tr>
								@endforeach
							</tbody>
							<!-- <tfoot>
								<tr>
				            		
				            		<th style="text-align: right;">Total Volume Page: </th>
				            		<th > </th>
				            		<th style="text-align: right;"></th>
				            		<th> </th>
				            		<th colspan="4"> </th>
				            	</tr>			            	
							</tfoot> -->
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
	     <br/><br/><br/>	<button class="btn-inverse btn" onclick="location.href='{{ url('sale/create') }}'">Create</button>
		</div>
	<!-- /page content -->
    
</div>
@endsection
