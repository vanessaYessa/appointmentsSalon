
@extends('layouts.master')

@section('content')
    <h3 class="blank1">Pre Qualification - Deal Center</h3>
    
    @if ( !$qualifications->count() )
        You have no qualifications
        
    @else
    
    <div class="col-sm-12">		
		{!! Form::open(array('action' => 'QualificationController@index', 'class' => 'form-horizontal')) !!}
		
		<table id="" class="table table-striped table-bordered display"  >
            <tr>
            	<th width="32%">
            		{!! Form::text('startdate', $filter[0], ['class' => 'form-control2',  'id' => 'datepicker', 'placeholder' => 'Creration Date >=', 'style' => 'width:130px']) !!}
					&nbsp;
					{!! Form::text('enddate', $filter[1], ['class' => 'form-control2','id' => 'dateendpicker', 'placeholder' => 'Creration Date <=', 'style' => 'width:130px']) !!}
				</th>
				
				<th >
					 {!! Form::select('associate', $associates, $filter[2], ['class'=> 'form-control']) !!}
				</th>
				<th>
					{!! Form::select('appliedFor', $appliedFor, $filter[4], ['class'=> 'form-control']) !!}
				</th>
			 </tr>	
			 
			 <tr>	
				<th >
					{!! Form::select('loanPurpose', $loanPurpose, $filter[3], ['class'=> 'form-control']) !!}
				</th>
				<th >
				
				</th>
				<th >
					{!! Form::submit('Filter', ['class'=> 'btn btn-primary']) !!} 
					{!! Form::reset('Reset', ['class'=> 'btn-btn-info btn']) !!}
				</th>
            </tr>
         </table>
	{!! Form::close() !!} 
	</div>
	
	
	<script>
		$(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
	
		$( document ).tooltip({
		  show: null, // show immediately 
		  items: '.btn-box-share',
		  hide: {
		    effect: "", // fadeOut
		  },
		  open: function( event, ui ) {
		    ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
		  },
		  close: function( event, ui ) {
		    ui.tooltip.hover(
		        function () {
		            $(this).stop(true).fadeTo(400, 1); 
		            //.fadeIn("slow"); // doesn't work because of stop()
		        },
		        function () {
		            $(this).fadeOut("400", function(){ $(this).remove(); })
		        }
		    );
		  }
		});
	</script>
    
    	@include('layouts.div-error')
    
	    <table id="example" class="table table-striped table-bordered display" >
            <thead>
                <tr>
                    <th>Borrower</th> 
                    <th>Sent by</th>                    
                    <th>Submission Date</th>
                   	<th>Feedback</th>
                   	<th>Assigned to</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            	@foreach( $qualifications as $qualification )
            		<tr> 
            			<td>
                        	<a href="{{ url('qualification/show', $qualification->a119_id) }}">{{ $qualification->borrower->a117_name }} {{ $qualification->borrower->a117_lastname }}</a>
                        </td>
                        <td> {{ $qualification->associate->a102_username}} </td>
                        <td> {{  App\Util::getStringTimestamp($qualification->a119_creationdate) }} </td>
                        <td >
	                       <span data-toggle="tooltip" title="{!!$qualification->a119_feedback!!}">{!! str_limit( $qualification->a119_feedback, 45) !!}</span>
                        </td>
                        <td>
                        	@if($qualification->assignedTo)
                       		 {{ $qualification->assignedTo-> a102_username }}
                       		@endif  
                       	</td>
                       <td> {!! App\Util::getQualificationStatus()[$qualification->a119_status] !!}   </td>
                       
                       <td>
							<!--  Security options -->
							<div class="dropdown">
								<a href="#"  class="btn btn-default" data-toggle="dropdown" aria-expanded="false">
									<i class="fa fa-cog icon_8"></i>
									<i class="fa fa-chevron-down icon_8"></i>
								<div class="ripple-wrapper"></div></a>
								<ul class="dropdown-menu pull-right">
								
									{!!Form::open(array('action' => array('QualificationController@destroy', $qualification->a119_id), 'method' => 'DELETE', 'id'=>'form'.$qualification->a119_id)) !!}
									<li style="margin-left: 20px">
										<a href="#" onclick="return multiply('{{ $qualification->borrower->a117_name }} {{ $qualification->borrower->a117_lastname }}', {{ $qualification->a119_id}});" class="font-red" title="">
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
        
         @include('layouts.popup')
         @include('layouts.confirmDelete')
         
    <!-- CALENDAR -->
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script>     
   
         var campaignId;
 		
 		function multiply(campaign, id) {			
 		    document.getElementById("confirmName").innerHTML =campaign;
 		    campaignId = id;
 		    $('#puConfirmD').modal();
 		}

 		function sendSubmit() {	
 			document.getElementById("form"+campaignId).submit();
 		}

 		$(document).ready(function() {

 			$( "#datepicker" ).datepicker({
 	 		    changeMonth: true,
 	 		    changeYear: true
 	 		  });

 	 		$( "#dateendpicker" ).datepicker({
 	 		    changeMonth: true,
 	 		    changeYear: true
 	 		  });
 	 			
 		  /*  $('#example1').DataTable( {
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
			       	 $( api.column( 1 ).footer() ).html(  "Total Volume " + tituloRate);    
		          	 $( api.column( 2 ).footer() ).html( resultTotal   );
		          		
		          	 $( api.column( 3 ).footer() ).html(  "Avg Rate" + tituloTotal );
	 		         $( api.column( 4 ).footer() ).html( resultRate   );
		          
 		        }
 		    } );*/
 		} );
		
	</script>
        
    @endif
@endsection