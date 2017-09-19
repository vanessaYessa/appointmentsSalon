
@extends('layouts.master')

@section('content')

	<div class="x_panel">
		<div class="x_title">
    		<h3 class="blank1">Prospects</h3>
    	</div>

	<script>
		$(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
	
		/*$( document ).tooltip({
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
		});*/
	</script>
		
	<div class="x_content">	
		<div class="col-sm-12">	
			{!! Form::open(array('action' => 'ProspectController@index', 'class' => 'form-horizontal')) !!}
			<table id="example1" class="table table-striped table-bordered display" >			
		            <tr>
		            	<th >
		            		{!! Form::text('name', $filter[9], ['class' => 'form-control',   'placeholder' => 'Name', 'style' => 'width:130px']) !!}
							
							{!! Form::text('lastname', $filter[10], ['class' => 'form-control','placeholder' => 'Lastname', 'style' => 'width:130px']) !!}
						</th>
						
						<th width="28%">
		            		{!! Form::text('startdate', $filter[1], ['class' => 'form-control2',  'id' => 'datepicker', 'placeholder' => 'Creation date >=', 'style' => 'width:130px']) !!}
							&nbsp;
							{!! Form::text('enddate', $filter[2], ['class' => 'form-control2','id' => 'dateendpicker', 'placeholder' => 'Creation date <=', 'style' => 'width:130px']) !!}
						</th>
						
						<th width="22%">
							{!! Form::select('statusType', $statusType, $filter[6], ['class'=> 'form-control', 'style'=> 'width: auto;']) !!}
						</th>
						<th>
							{!! Form::select('team', $teams, $filter[7], ['class'=> 'form-control', 'style'=> 'width: auto;']) !!}
						</th>
						<th>
							{!! Form::select('group', $groups, $filter[8], ['class'=> 'form-control', 'style'=> 'width: auto;']) !!}
						</th>
						<th>
							{!! Form::checkbox('showinactive', 1, $filter[5], ['class'=> 'checkbox1', 'style'=> 'font-size: 10px;']) !!} Show inactive
						</th>
					</tr>	
					<tr>
						<th style="vertical-align: top"  colspan="2">
							{!!Form::select('services[]', $services, $filter[0],
								['id' => 'my-select', 'multiple' => 'multiple', ])!!}
						</th>
						<th style="vertical-align: top">
						{!! Form::select('status', $statusAll, $filter[4], ['class'=> 'form-control', 'style'=> 'width: auto;']) !!}
						</th>
						<th >
							{!! Form::select('associates', $associatesAll, $filter[3], ['class'=> 'form-control', 'style'=> 'width: auto;']) !!}
						</th>
						<th colspan="2">
						{!! Form::submit('Search', ['class'=> 'btn btn-primary']) !!}
						</th>
		            </tr>
	         </table>
			{!! Form::close() !!} 
		</div>
	<br/>
	
	@if ( $prospects == null)
	
	@elseif (!$prospects->count() )
		Any prospect was found 
	@else

		@include('layouts.div-error')
			    
		<table id="example" class="table table-striped table-bordered display" >
			<thead>
	        	<tr>
	            	<th>Name</th>
	                <th>Contact Info</th>
	                <th width="15%">Service</th>
	                <th>Last Follow Up</th>
	                <th>Assited by</th>
	                <th>
	                	@if( Session::get('active_user')['a104_roleid'] == 5 )
	                		Created on
	                	@else
	                		Created by
	                	@endif
	                </th>
	                <th width="10%" >Prospect Type</th>
	                <th width="10%" >Status</th>
	                <th></th>
				</tr>
			</thead>
		                    
		    <tbody>
		    	@for ($i = 0; $i < $prospects->count(); $i++)
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
	                        	 @if ( $prospect->a103_mobile != null && $prospect->a103_mobile != '' )
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
	                        
	                        <td>
	                        	 @foreach( $prospect->services as $service )     
	                        	 	  {{ $service->a105_name }} <br/>
	                        	 @endforeach
	                      </td>
	                        
	                        <td width="10%">
	                        	@if ( $prospect->lastfollowup != null ) {{  App\Util::getStringTimestamp($prospect->lastfollowup) }}  @endif
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
	    						<span id="span_statustype{{$prospect->a103_id}}" >
	                        		{!! $prospect->a020_name  !!}
	                        	</span>
	    
	                        	<div id="div_statustype{{$prospect->a103_id}}" style="display: none;" >
		                       		
	                       		</div>
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
						<td>
							<!--  Security options -->
					<div class="dropdown">
						<a href="#" title="" class="btn btn-default" data-toggle="dropdown" aria-expanded="false">
							<i class="fa fa-cog icon_8"></i>
							<i class="fa fa-chevron-down icon_8"></i>
						<div class="ripple-wrapper"></div></a>
						<ul class="dropdown-menu pull-right">
							
							
							<li>
								<a href="#" onclick="shareProspect({{ $prospect->a103_id }}, '{{ $prospect->a103_name }} {{ $prospect->a103_lastname }}')" >
									<i class="icon-share-2" ></i>
									Share
								</a>
							</li>
							
							<li>
								<a href="#" onclick="getStatusByTypeProspect('role{{$prospect->a103_id}}', {{ $prospect->status->a012_typeid }}, {{$prospect->a103_status}}); showRoleToChange( {{ $prospect->a103_id }}, {{ $prospect->a103_status }});">
									<i class="icon-forward"></i>
									Change Status
								</a>
							</li>
							
							<li>
								<a a href="{{ url('qualification/create', $prospect->a103_id) }}" >
									<i class="mif-stack"></i> &nbsp;
									Deal Center
								</a>
							</li>
							
							<li>
								<a a href="{{ url('transaction/create', $prospect->a103_id) }}" >
									<i class="mif-dollar2"></i> &nbsp;
									Originate
								</a>
							</li>
							
						
							
							<li class="divider"></li>
							{!!Form::open(array('action' => array('ProspectController@destroy', $prospect->a103_id), 'method' => 'DELETE', 'id'=>'form'.$prospect->a103_id)) !!}
							<li style="margin-left: 20px">
								<a href="#" onclick="return multiply('{{ $prospect->a103_name}}', {{ $prospect->a103_id}});" class="font-red" title="">
									<i class="fa fa-times" ></i>
									Delete
								</a>
							</li>
							{!! Form::close() !!}
						</ul>
					</div> <!-- ./Security options -->
								
							</td>
	                    </tr>
	                @endfor
	            </tbody>
	        </table>
	        @include('layouts.table')
	        
	        
		    <div class="modal fade" id="shareProspect" tabindex="-1" role="dialog"
					aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							{!! Form::open(array('action' => 'ProspectController@share', 'class' => 'form-horizontal')) !!}
							{!! Form::hidden('prospectId', null, ['id'=> 'prospectId']) !!}
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-hidden="true">X</button>
								<h5 class="modal-title" >
									 Share prospect: &nbsp;&nbsp;<span id="shareName"></span>
								</h5>
							</div>
							<div class="modal-body">
								<div class="form-group">
				                    <label class="col-sm-2 control-label">Member</label>
				                    <div class="col-sm-4">
				                        {!!Form::select('associate', $associates, null, ['class'=> 'form-control'])!!}
				                    </div>
				                </div>
				                
				                <div class="form-group">
				                    <label class="col-sm-2 control-label">Message</label>
				                    <div class="col-sm-4">
				                        {!!Form::textarea('message', null, null, ['class'=> 'form-control', 'id' => 'message'])!!}
				                    </div>
				                </div>
				                
				                 @if($errors->all())
								    <p class="alert alert-danger">
							        	@foreach($errors->all() as $error)
							                {{$error}}<br/>
							            @endforeach
							        </p>
							        
							        <script type="text/javascript">
										 $(window).load(function(){
									        $('#shareProspect').modal('show');
									    });
									 </script>
								@endif
							</div>
							<div class="modal-footer">
								<div id="delmodelcontainer" style="float: right">
									<div id="yes" style="float: left; padding-right: 10px">
									{!!Form::submit('Send invitation', array('class' => 'btn btn-primary'))!!} 
									</div>
									<div id="no" style="float: left;">
										<button type="button" class="btn btn-defualt" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</div>
							{!! Form::close() !!}
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				
		@include('layouts.popup')
		@include('layouts.confirmDelete')
	    
	    @endif
	    
	    
    </div>
	<!-- Express Prospect Modal -->
	
	<br/>
	<button class="btn-inverse btn" onclick="location.href='{{ url('prospect/create') }}'">Create</button>
	
	
	
	<!--  -->	
	<link rel="stylesheet" href="{{ asset ('css/sol.css')}}" type='text/css' />
	<style>
		.sol-selected-display-item { display: inline-block;}
	</style>
	 <script src="{{ asset ('js/sol.js')}}"></script> 
	
	<!-- CALENDAR -->
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script>
   		var campaignId;
	 		
        function shareProspect(id, prospectName) {
  		    $('#prospectId').val(id);
  			$('#shareName').html(prospectName);
  			$('#message').val('I want to share my prospect '+ prospectName+' with you ');
  			$('#shareProspect').modal();
  		}

    	function multiply(campaign, id) {			
 		    document.getElementById("confirmName").innerHTML =campaign;
 		    campaignId = id;
 		    $('#puConfirmD').modal();
 		}

 		function sendSubmit() {	
 			document.getElementById("form"+campaignId).submit();
 		}

 		 $(function() {
 			$('#my-select').searchableOptionList( {
 		        texts: { searchplaceholder: 'Select service *' }
 		    });
 		});

 		$( "#datepicker" ).datepicker({
 		    changeMonth: true,
 		    changeYear: true
 		  });

 		$( "#dateendpicker" ).datepicker({
 		    changeMonth: true,
 		    changeYear: true
 		  });
		</script>
@endsection