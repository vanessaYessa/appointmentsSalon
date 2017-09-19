@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>
						Follow Up Prospects <small> </small>
					</h2>
					<ul class="nav navbar-right panel_toolbox"> 
						<li><a class="close-link" href="{{ url(Session::get('init_page'))}}"><i class="fa fa-close"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">				
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Phone</th>
								<th>Last Follow Up</th>
								<th>Created on</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						
		    	@for ($i = 0; $i < count($prospects); $i++)
		    	<?php 
	            	$prospect = $prospects[$i];   
	            	$memberid = $prospect->a103_id;
	        	?>
	        	
	        	        <tr> 
	        	        	<td width="18%">
	                        	<span class="mif-{!!$prospect->a103_gender!!} mif-2x" data-toggle="tooltip" title="{!!$prospect->a103_gender!!}"></span>
	                        	<a href="{{ url('prospect/show', $prospect->a103_id) }}" data-toggle="tooltip" title="{!!$prospect->a103_sourcecomment!!}">{{ $prospect->a103_name }} {{ $prospect->a103_lastname }}</a>
	                        </td>
	                        <td>
	                        	 @if ( $prospect->a103_mobile != null )
	                        		{{ phone_format($prospect->a103_mobile, 'US', 2)}}
	                        	 @endif
	                        	 
	                        	 <br/>
	                        	 <!-- Email -->
	                        	 @if ( $prospect->a103_email != null )
	                        		<span class="mif-mail mif-2x" data-toggle="tooltip" title="{!!$prospect->a103_email!!}"></span>&nbsp;&nbsp;&nbsp;&nbsp; 
	                        	@endif	
	                        	
	                        	<!-- Phone -->
	                        	 @if ( $prospect->a103_phone != null)
			                	 	<span class="icon-phone" data-toggle="tooltip" title="{{ phone_format($prospect->a103_phone, 'US', 2)}}"></span>&nbsp;&nbsp;&nbsp;&nbsp; 
			                	 @endif
	                        	 
	                        	
	                       	</td>
	                        
	                        <td> {{  App\Util::getStringFormat2($prospect->day_to_follow_up) }} </td>
	                        
		                    <td>
			                	@if( Session::get('active_user')['a104_roleid'] == 5 )
			                		{{  App\Util::getStringFormat2($prospect->a103_creationdate) }}
			                	@else
			                		{{$prospect->createdBy->a102_username}}<br/>
			                		{{  App\Util::getStringFormat2($prospect->a103_creationdate) }}
			                	@endif
			                </td>
	                        
							<td>
	                        	<span id="span_role{{$prospect->a103_id}}" >
	                        		
	                        	</span>
	                        	
		                      	
							</td>
	                    </tr>
	                @endfor
						</tbody>
					</table>
					@include('layouts.table')
				</div>
			</div>
		</div>
	</div>
@endsection