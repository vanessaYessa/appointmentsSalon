@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>
						@if ( $reportid== 1 )
							New
					    @elseif ( $reportid == 2 )
							Loan Pipeline
						@elseif ( $reportid == 3 )
							Closed Loan								
						@endif
						Transactions
						<small> @if ( isset($date) ) {{ $date}} @endif</small>
					</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="close-link" href="{{ url(Session::get('init_page'))}}"><i class="fa fa-close"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">				
					<table id="example" class="table table-striped table-bordered">
						<thead>
							<tr>
			                    <th>Borrower</th>                    
			                    <th width="110px">Loan Officer</th>
			                    <th width="100px">Amount</th>
			                    <th width="90px">Loan number</th>
			                    <th width="70px">Interest rate</th>
			                    <th>Origination Date</th>
			                    <th>Loan Life <br> (days)</th>
			                   @if ( $reportid == 3 || $reportid == 1 )
			                    	<th>Closing Date</th>
			                    @endif
			                    <th>Applied for</th>
			                    <th>Loan purpose</th>
			                    <th>Status</th>
			                </tr>
						</thead>
						
						<tbody>
		    				@foreach( $transactions as $transaction )
		            	    <tr> 
		                         <td>
		                        	<a href="{{ url('transaction/show', $transaction->a116_id) }}">{{ $transaction->borrower->a117_name }} {{ $transaction->borrower->a117_lastname }}</a>
		                         </td>
		                         <td> {{ $transaction->associate->a102_username}} </td>
		                       	 <td align="right">  ${{ App\Util::formatNumber($transaction->a116_amount)  }}</td>
		                         <td> {{ $transaction->a116_loannumber}} </td>
		                         <td align="right"> {{ $transaction->a116_interestrate}}% </td> 
		                         <td >
		                        	@if ( $transaction->a116_origindate != null ) {{  App\Util::getStringFormat2($transaction->a116_origindate) }}  @endif
		                         </td>
		                         <td> {{ $transaction->loanlife}}</td> 
		                        @if ( $reportid == 3 || $reportid == 1 )
		                         <td >
		                        	@if ( $transaction->a116_closingdate != null ) {{  App\Util::getStringFormat2($transaction->a116_closingdate) }}  @endif
		                        </td>
		                        @endif
		                        <td>{{ $transaction->appliedFor->a021_name }}  </td>
		                         <td>{{ $transaction->loanPurspose->a021_name}}</td>
		                         <td>
		                       		{!! $transaction->status->a022_name !!}
		                       </td>
		                    </tr>
		                	@endforeach	
						</tbody>
						<tfoot>
			            	<tr>
			            		<th style="text-align: right; vertical-align: middle;">Total Transactions: {!! $transactions->count()!!}</th>
			            		<th style="text-align: right;">Total Volume Page: </th>
			            		<th > </th>
			            		<th style="text-align: right;"></th>
			            		<th> </th>
			            		<th colspan="4"> </th>
			            	</tr>
						</tfoot>
					</table>
				</div>
				
				 <script>     
   
		        $(document).ready(function() {
			        
		 		    $('#example').DataTable( {
		 		    	dom: '<"top">flt<"bottom">i<br/>Bp',
		 		    	pageLength: 50,
		 		    	stateSave: true,
		 		    	order: [[ 5, "asc" ]],
		 	    		buttons: [
		 	    		          {
		 	    		              extend: 'copy',
		 	    		              text: 'Copy',
		 	    		              exportOptions: {
		 	    		                  modifier: {
		 	    		                      search: 'none'
		 	    		                  }
		 	    		              }
		 	    		          },
		 	    		          {
		 	    		              extend: 'csv',
		 	    		              text: 'CSV',
		 	    		              exportOptions: {
		 	    		                  modifier: {
		 	    		                      search: 'none'
		 	    		                  }
		 	    		              }
		 	    		          },
		 	    		          {
		 	    		              extend: 'excel',
		 	    		              text: 'Excel',
		 	    		              exportOptions: {
		 	    		                  modifier: {
		 	    		                      search: 'none'
		 	    		                  }
		 	    		              }
		 	    		          }
		 	    		          ,
		 	    		          {
		 	    		              extend: 'pdf',
		 	    		              text: 'PDF',
		 	    		              exportOptions: {
		 	    		                  modifier: {
		 	    		                      search: 'none'
		 	    		                  }
		 	    		              }
		 	    		          }
		 	    		      ],
		 		        "footerCallback": function ( row, data, start, end, display ) {
		 		            var api = this.api(), data;
		 		 
		 		            // Remove the formatting to get integer data for summation
		 		            var intVal = function ( i ) {
		 		                return typeof i === 'string' ?
		 		                    i.replace(/[%\$,]/g, '')*1 :
		 		                    typeof i === 'number' ?
		 		                        i : 0;
		 		            };
		
		 		          	var totalSho = api.page.info().recordsDisplay;
		 		          	var totalPage = api.page.len();
						 	var moreThan2Pages = false;
							var pageTotalAmount = 0;
							var pageTotalRate = 0;
			 		          if(api.page.info().pages > 1)
			 		          {
			 		        	 moreThan2Pages = true;
			 		        	// Total over this page
			 	 		        pageTotalAmount = api.column( 2, { page: 'current'} ).data()
			 	 		          	.reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
			
			 	 		          // Total over this page
			 			        pageTotalRate = api.column( 4, { page: 'current'} ).data()
			 			            .reduce( function (a, b) { return intVal(a) + intVal(b);  }, 0 );
			 	 		      }
		
			 		            // Total Amount over all pages
			 		          	totalAmount = api.column(2 ).data()
			 		                .reduce( function (a, b) {  return intVal(a) + intVal(b);}, 0 );
					                
			 		           	totalRate = api.column(4 ).data()
				                	.reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
			 		 
			
								var resultRate = (pageTotalRate / totalPage).toFixed(2) +'% ' ;
								var tituloRate = "";
								
			 		          	if(moreThan2Pages) {
			 		         		resultRate +='<br/><br/> '+ (totalRate / totalSho).toFixed(2) + '%' ;
			 		         		tituloRate += " Page:<br/><br/> Total Volume:";
			 		          	}
			 		            else
						        {
			 		        	  resultRate = (totalRate / totalSho).toFixed(2) +'% ' ;
						        }	
			 		       		
		
		
			 		          var resultTotal = '$ '+pageTotalAmount.toLocaleString();
			 		          var tituloTotal = "";
					          if(moreThan2Pages) {
					          		resultTotal += ' <br/><br/> $ '+ totalAmount.toLocaleString() ;
					          		tituloTotal += '  Page:<br/><br/> Avg Rate:'
					          }
					          else
					          {
					        	  resultTotal = '$ '+totalAmount.toLocaleString();
					          }
		
						       //Update footer
					       	 $( api.column( 1 ).footer() ).html(  "Total Volume: " + tituloRate);    
				          	 $( api.column( 2 ).footer() ).html( resultTotal   );
				          		
				          	 $( api.column( 3 ).footer() ).html(  "Avg Rate: " + tituloTotal );
			 		         $( api.column( 4 ).footer() ).html( resultRate   );
				          
		 		        }
		 		    } );
		 		} );
				
			</script>
			</div>
		</div>
	</div>
@endsection