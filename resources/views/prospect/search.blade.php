@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>
						@if ( $reportid== 1 )
							Corporate Leads
					    @elseif ( $reportid == 2 )
							Corporate Leads result
						@elseif ( $reportid == 3 )
							My own Leads
						@elseif ( $reportid == 4 )
							My own Leads			
						@endif
						
						Prospects <small> </small>
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
								<th>Assisted by</th>
								<th>Created by</th>
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
	                        	<a href="{{ url('prospect/edit', $prospect->a103_id) }}" data-toggle="tooltip" title="{!!$prospect->a103_sourcecomment!!}">{{ $prospect->a103_name }} {{ $prospect->a103_lastname }}</a>
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
	                        	 
	                        	<!-- Ciudad -->
	                        	@if ( $prospect->a003_name != null )
	                        		<span class="icon-home " data-toggle="tooltip" title="{!!$prospect->a003_name!!}"></span>&nbsp;&nbsp;&nbsp;&nbsp; 
	                        	@endif	
	                       	</td>
	                        
	                        <td> {{$prospect->assistedBy->a102_username}} </td>
	                        
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
	                        		{!! $prospect->status->a012_name  !!}
	                        	</span>
	                        	
		                      	<div id="div_role{{$prospect->a103_id}}" style="display: none;" >
		                      	{!! Form::select('statusType', $statusType, $prospect->status->a012_typeid, ['class'=> 'form-control', 'id'=> 'statustype'.$memberid, 'onchange' => 'getStatusByTypeProspect(\'role'. $memberid. '\', this.value,'. $prospect->a103_status.');']) !!}
		                      	
	                       		{!! Form::select('role', [$prospect->status->a012_id => $prospect->status->a012_name], $prospect->a103_status, ['class'=> 'form-control', 'id'=> 'role'.$memberid, 'onchange' => 'changeProspectStatus('. $memberid. ', this.value, 1);'], array('a012_id', 'a102_name')) !!}
		                       </div>
							</td>
	                    </tr>
	                @endfor
						</tbody>
					</table>
					@include('layouts.table')
				</div>
				<div class="col-sm-6">
					<button class="btn-inverse btn" onclick="location.href='{{ url('prospect/create') }}'">Create</button>
			    </div>
			    
			</div>
		</div>
	</div>
@endsection