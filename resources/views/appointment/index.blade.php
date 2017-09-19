
@extends('layouts.master')

@section('content')


<!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

<div class="right_col" role="main">
	
	 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             <span id="username"></span> Appointments 
          </h1>
          @if($calendaruserid > 0 )
          @foreach( $statuslist as $st )  
			<button type="button" 
				class="btn btn-primary" style="float: left;background-color:{{ $st->a09_color }}; color: white">
				{{ $st->a09_name }}
			</button>
          @endforeach
          @endif
     	</section>

        <!-- Main content -->
			<section class="content">
					<div class="pull-right" style="float:right">
						
						<button onclick="window.location='{{ url('appointments') }}'" type="button" 
							class="btn btn-primary" style="float: left;background-color: black; color: white">
								Salon
							</button>
							@foreach( $userlist as $user )  
								<button onclick='showCalendarByUser( {{ $user->a01_id }} );' type="button" 
								class="btn btn-primary" style="float: left;background-color:{{ $user->a01_calendarcolor }}; color: white">
									{{ $user->a01_username }}
								</button>
		                	@endforeach
				 	</div>	
				 	
				 	
				 	<div class="pull-right" style="float:right">
						<?php 
							$userlist = Session::get('userlist');
						?>		
									
						
				 	</div>	
				 	
				 	
						<br/><br/>
					<div class="col-md-12">
						<!-- THE CALENDAR -->
						
						<div id="calendar"></div>
						<!-- /. box -->
					</div>
				<!-- /.row -->
			</section>
      </div><!-- /.content-wrapper -->
      
      
            <!-- Modal to Create Appoitment -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Create Appointment</h4>
				</div>
			
				<div class="modal-body">	
					{!! Form::open(array('action' => 'AppointmentController@storeMassive', 'class' => 'form-horizontal', 'id' => 'appointmentform', 'data-parsley-validate')) !!}
						{!! Form::hidden('appointmentid',  "", ['id' => 'appointmentid']) !!}
						{!! Form::hidden('title', null,  ['id' => 'title']) !!}
						{!! Form::hidden('servicesel', null,  ['id' => 'servicesel']) !!}
						{!! Form::hidden('usersel', null,  ['id' => 'usersel']) !!}
						{!! Form::hidden('userdivsel', null,  ['id' => 'userdivsel']) !!}
						
						{!! Form::hidden('stylist[]', null,  ['id' => 'stylist']) !!}
						{!! Form::hidden('services[]', null,  ['id' => 'services']) !!}
						{!! Form::hidden('associate[]', null,  ['id' => 'associate']) !!}
						{!! Form::hidden('starttime[]', null,  ['id' => 'starttime']) !!}
						{!! Form::hidden('endtime[]', null,  ['id' => 'endtime']) !!}
						{!! Form::hidden('duration[]', null,  ['id' => 'duration']) !!}
					<div class="col-md-6">
	              		
	              		
	              		<div class="col-md-6 col-xs-12">
	              			<label for="fullname">Date* :</label>  
	              			<div class="input-group" id="dateDiv"> 
	              			   <label class="input-group-addon" for="dataScaleX"><i class="fa fa-calendar"></i></label>
								{!! Form::text('startdate', null, ['class'=> 'form-control', 'id' => 'startdate', 'onChange' => 'document.getElementById("enddate").value = this.value']) !!}
								{!! Form::hidden('enddate',  null, ['id' => 'enddate']) !!}
							 </div>
	              		</div>
	              		
	              		<div class="col-md-6 col-xs-12">
	              			<label for="fullname">Start time * :</label>  
	              			<div class="input-group" id="timeStartDiv">
								<div class="input-group-addon">
								  <i class="fa fa-clock-o"></i>								  
								</div>
								{!! Form::text('time',  null, ['id' => 'time', 'class'=>
									'form-control', 'placeholder' => 'Time end *']) !!}		
								{!! Form::hidden('timeend',  null, ['id' => 'timeend']) !!}						 
							</div>
	              		</div>
	              		
	              		<div class="col-md-12 col-xs-12" id="customerinformationdiv">
	              			<div class="x_panel">
			                  <div class="x_title">
			                    <h2>Customer information </h2>   
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                  
			                  	<div class="row col-md-12" id="oldclient" style="display: none;">
		                  				<div class="row details-container" >
											<div class="col-xs-8 col-sm-8 col-md-6">
												<div class="contact details">
													<div class="fs-16" id="oldclientinfo"></div>
												</div>
											</div>
											<div class="col-xs-4 col-sm-4 col-md-6" id="changeclient">
												<div class="form-group no-margin text-right" id="changeclient">
													<a class="btn btn-default" href="#" id="changeclient">
													<span class="" id="changeclient">Change Client</span> </a>
												</div>
											</div>
										</div>
										<div>
											<label id="lastvisit"></label>
										</div>
									</div>
				                  
			                  	<div class="col-md-12 col-xs-12" id="newclient">
				                  		<div class="">
				                  			<div class="col-md-6 col-xs-12">
				                  				<label for="fullname">Name * :</label>                      	
						                      	{!! Form::text('name', null, ['id' => 'name', 'class'=> 'form-control ', 'autocomplete' => 'off']) !!}
												
												{!! Form::hidden('clientid',  null, ['id' => 'clientid']) !!}
												
												<label>Mobile *:</label>
					                   			{!! Form::text('phone', null, ['id' => 'phone', 'class'=> 'form-control', 'autocomplete' => 'off' ]) !!}
					                   			
					                   			
						                   		<!-- <label for="email">Email:</label> -->
						                      	<input type="email" id="email" class="form-control" name="email" style="display:none"  />
						                    </div>
				                  			
				                  			<div class="col-md-6 col-xs-12">
				                  				<label for="fullname">Lastname :</label>                      	
					                      		<input type="text" id="lastname" class="form-control" name="fullname"  />
					                      		
					                      		<!-- <label>BOD:</label> -->
					                   			{!! Form::text('bod', null, ['id' => 'bod', 'class'=> 'form-control', 'style' => 'display:none;' ]) !!}
					                   			
					                   			<label>Gender:</label>
						                   		<div class="inline-form">
													<span >{!!Form::radio('gender', 1, true, ['id' => 'gender'])!!} Female&nbsp;&nbsp;&nbsp;
													{!!Form::radio('gender', 2, false,  ['id' => 'gender'])!!} Male </span>
												</div>
												
												
												<div class="actionBar">			                   		
						                   			<button type="button" class="btn btn-danger" onclick="getProspectList();" ><i class='fa fa-search'></i> Search</button>
						                   		</div>
				                  			</div>
										</div>
					               	 </div>
				              			
				              		
				              		<div class="col-md-12 col-xs-12">
				              			<div id="customer" class="">
				              				<div id="livesearch"></div>
				              			</div>
				              		</div> 
				                  </div>
				                  
				                  
			                </div>
	              		</div>
	              		
	              		<div class="col-md-12" id="afterdate" style="display: none;">
							<div class="x_panel_cal">
								<div class="x_content_cal">
									<div class="col-md-12 col-xs-12">
										<label for=""> 	 </label> 
										
										<input type="hidden" class="sr-only" name="statusid" id="statusid">
										<div class="btn-group btn-group-justified" data-toggle="buttons">
										<?php  $cont = 0; ?>  
				                		@foreach( $status as $id => $name )
				                			<label class="btn btn-primary" id="label{!! $id !!}" onclick="setStatusApp({!! $id !!});">
										 	<span class="docs-tooltip" >
					                            {!! $name!!}
					                          </span>
					                        </label>
										<?php  $cont++ ?>
						                @endforeach
						                </div>
									</div>
								</div><br/><br/>
								<div class="col-md-12" id="createdOn"><br/></div>
							</div>
						</div>
						
						<div class="col-md-12" id="statusaccomplished" style="display: none;">
							<div class="x_panel_cal">
								<div class="x_content_cal">
									<div class="col-md-12 col-xs-12">
										<label for="">Would you like to generate an inbox: </label> 
										<div class="checkbox">
				                            <label>
				                              <input type="checkbox" class="flat" checked="checked"> Checked
				                            </label>
				                          </div>
				                          
										<label class="btn btn-primary" id="label{!! $id !!}" onclick="setStatusApp({!! $id !!});">
										 	<span class="docs-tooltip" >
					                            Yes
					                          </span>
					                        </label>
					                        
					                     <label class="btn btn-primary" id="label{!! $id !!}" onclick="setStatusApp({!! $id !!});">
										 	<span class="docs-tooltip" >
					                            No
					                          </span>
					                        </label>   
										<input type="hidden" class="sr-only" name="createinbox" id="createinbox">
										<div class="btn-group btn-group-justified" data-toggle="buttons">
										
						                </div>
									</div>
								</div><br/><br/>
								<div class="col-md-12" id=""><br/></div>
							</div>
						</div>
						
						
	              	</div>
	              	<div class="col-md-6">
	              			
		              	<div class="row">
		              		<div class="col-md-12 col-xs-12">
		              			<div class="x_panel_cal">
				                  <div class="x_content_cal">
				                  
				                  	<div class="col-md-12" >
				                		<label for="">Service</label>
				                		<div class="carousel">
				                			<?php  $cont = 0 ?>  
				                			@foreach( $services as $id => $name )
					                        <div class="col-md-1" id="service{!! $cont !!}" onclick='selectService( {!!$id!!}, "service{!! $cont !!}");'>
					                         	<img class="img-circle" width="45px" height="45px" src="images/2.jpg" style="width: 45px; height: 45px;" >
											<p>{!! $name!!}</p>
											</div>
											<?php  $cont++ ?>
						                	@endforeach
										</div>		                      	
					                </div>	
					               	
					               	<div class="col-md-12">
					               		<label for="">Stylist</label>
					               		<div class="carousel2">	
					               			<?php  $cont = 0 ?>  	                			
				                			@foreach( $users as $id => $name )
					                        <div class="col-md-1" id="user{!! $cont !!}" onclick='selectUser( {!! $id!!}, "user{!! $cont !!}");'>
					                         	<img class="img-circle" width="45px" height="45px" src="images/3.jpg" style="width: 45px; height: 45px;" >
											<p>{!! $name!!}</p>
											</div>
											<?php  $cont++ ?>
						                	@endforeach
										</div>
										<div class="actionBar">
										<button id="addButton" type="button" class="btn btn-danger" onclick="setPairValue();" ><i class="fa fa-plus"></i> Add </button>
										</div>
						            </div>
				                  </div>
				                  
				                 
				                </div>
		              		</div>
		              	</div>
		              	
		              	<div class="row">
		              		<div class="col-md-12 col-xs-12">
		              			<div class="x_panel_cal">
				                  <div class="x_content_cal">
				                  
				                  	<div class="col-md-12" >
				                  		<label for="">Selected Service</label>              			
				                  		<table style="width: 100%" class="table table-border" id="finaltable">
					               			<tr>
					               				<td>Service</td>
					               				<td>Stylist</td>
					               				<td>Time</td>
					               				<td>Minutes</td>
					               				<td></td>
					               			</tr>
					               		</table>
				                  	</div>
				                  </div>
				                </div>
				            </div>
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
									 $('.modal-dialog').css('width', '900px'); 
									//$(".modal-dialog").width(width).height(height).css({top:0,left:0});
							        $('#myModal').modal('show');
							    });
							 </script>
						@endif
				</div> 
				
				
				<div class="modal-footer">
					<button id="deleteButton" style="float: left; display: none;" type="button" class="btn btn-danger" data-dismiss="modal" onclick="return confirmDelete();" >Delete</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					{!! Form::submit('Add', ['class'=> 'btn btn-primary btn-flat', 'id'=> 'add-new-event', 'onclick'=> 'setTitle()']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
            
 <div class="modal fade" id="puConfirmD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">X</button>
				<h5 class="modal-title" id="myModalLabel1">
					<b><span style="color: red;" class="glyphicon glyphicon-warning-sign">
					</span>  &nbsp;
					Are you sure you want to delete the appointment for <span id="confirmName"></span></b>
				</h5>
			</div>
			<div class="modal-footer">
				<div id="delmodelcontainer" style="float: right">
					<div id="yes" style="float: left; padding-right: 10px">
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteAppointment();">Yes. delete</button>
					</div>
					<div id="no" style="float: left;">
						<button type="button" class="btn btn-defualt" data-dismiss="modal">No</button>
					</div>
				</div>
				<!-- end delmodelcontainer -->

			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
	<!-- /page content -->    
</div>
	 

<?php $avoidcache = time(); ?>
		
	<script src="{{ asset ('js/ajax-functions.js?' . $avoidcache)}}" type="text/javascript"></script>
	 <!-- jQuery -->
    <script src="{{ asset ('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset ('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    
	<link rel="stylesheet" href="{{ asset ('js/fullcalendar/fullcalendar.min.css')}}" type='text/css' />
    <link rel="stylesheet" href="{{ asset ('js/fullcalendar/fullcalendar.print.css')}}" type='text/css' media='print'  />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />   
	<!-- Bootstrap time Picker -->
	<script src="{{ asset ('js/time/jquery.plugin.js')}}"></script>
	<script src="{{ asset ('js/time/jquery.timeentry.js')}}"></script>
	<link href="{{ asset ('js/time/jquery.timeentry.css')}}" rel='stylesheet' />   

	<link rel="stylesheet" href="{{ asset ('css/sol.css')}}" type='text/css' />
	<script src="{{ asset ('js/sol.js')}}"></script>
	<style>
		/** Show options in one line */
		.sol-selected-display-item { display: inline-block;}
	</style>

    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="{{ asset ('js/fullcalendar/fullcalendar.min.js')}}"></script>

     
    <!-- CALENDAR -->
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

	<script src="{{ asset ('js/jquery.maskedinput.min.js')}}"></script>
	
	
	<link href="{{ asset ('js/slick/slick.css')}}" rel="stylesheet">
	<link href="{{ asset ('js/slick/slick-theme.css')}}" rel="stylesheet">
	<script src="{{ asset ('js/slick/slick.min.js')}}"></script>	
	<script src="{{ asset ('js/salon.js')}}"></script>	
	
    <!-- Page script -->
    <script type="text/javascript"  >

		function deleteAppointment() { 
 		    document.location.href = localhost + "/appointment/delete/" + $('#appointmentid').val();
 		}

		function confirmDelete(campaign) {			
 		    document.getElementById("confirmName").innerHTML = $('#name').val() + " "  + $('#startdate').val();
 		   	$('#puConfirmD').modal();
 		   
 		}
  		
	    $(function () {

		    $("#phone").mask("(999) 999-9999");
	    	
	    	 $('#my-select').searchableOptionList( {
	 			texts: { searchplaceholder: 'Select service *'}, 
	 			showSelectionBelowList: false 
	 		 });
	      		$('.carousel2').slick({
	    	  		slidesToShow: 4,
	    	  		slidesToScroll: 1,
	    	  		autoplay: true,
	      		  	adaptiveHeight: true,
	    	  		autoplaySpeed: 6000,
	    	  		cssEase: 'linear'
	    	  		});

	  	    	$('.carousel').slick({
	      		  slidesToShow: 4,
	      		  slidesToScroll: 1,
	      		  autoplay: true,
	      		  adaptiveHeight: true,
	      		  autoplaySpeed: 5000,
	      		  cssEase: 'linear'
	      		});

	        /* initialize the calendar
	         -----------------------------------------------------------------*/
	        $('#calendar').fullCalendar({
	        	minTime: "08:00:00",
	        	maxTime: "21:00:00",
	        	slotEventOverlap: false,
	        	cache: false,
	        	allDaySlot: false,
	        	slotDuration: '00:15:00', 	
	  	        displayEventEnd: false, 
	  	       header: {
		            left: 'prev,next today',
		            center: 'title',
		            right: 'month,agendaWeek,agendaDay'            
		        },
		        buttonText: {
		            today: 'today',
		            month: 'month',
		            week: 'week',
		            day: 'day'
		        },	
		        dayClick: function(date, jsEvent, view) { 
	
		        	  clearForm();
		        	  $("#startdate" ).datepicker('setDate', date.format('MM/DD/YYYY'));
		        	  $("#enddate" ).datepicker('setDate', date.format('MM/DD/YYYY'));
	
		        	  if(date.format('HH:mm') == '00:00')
		        		$("#time").timeEntry('setTime', 'now');
		        	  else
		        	  	$("#time").timeEntry('setTime', date.format('HH:mm a'));
			      		
		        	  //$("#enddate" ).datepicker('setDate', date.format('HH:MM P'));
		        	  $("#startdate").datepicker({changeMonth: true, changeYear: false, dateFormat: 'mm/dd/yy'});
		              $('.modal-dialog').css('width', '900px');
		             // $(".modal-dialog").width(width).height(height).css({top:0,left:0}); 
                      $('#myModal').modal('show');              
		          },
		          eventClick: function(calEvent, jsEvent, view) {
		              $.ajax({
		                  url: localhost + '/getAppointmentByClient',
		                  type: "GET",
		                   data: { 
		                	  id: calEvent.id, 
		                	  dateapp: calEvent.start.format('YYYY/MM/DD')
		                  },
		                  error: function(xhr, status, error) {
		                      
		      				//handle errors
		                  },
		                  success: function(result) {
		                	  showEvent(result);
		                  } // end on sucess
		              }); // end ajax call
		          },
		          editable: false,
		          defaultView: 'agendaWeek',
		          droppable: false, // this allows things to be dropped onto the calendar !!!
		          events:  {
		        	  url:  localhost + 'getAppointments',
		              type: 'GET',
		              cache: false,
	                  data: { 
	                	  userid: {{ $calendaruserid }}
	                  },
	                  success: function(result) {
	                      if({{ $calendaruserid }} > 0)
	                	  	$("#username").html( result[0].username + "'s "); 
	                  }, // end on sucess
		              dataType: "json",
		              headers : {'Content-Type':'application/json; charset=utf-8'},
		              contentType: "application/json; charset=utf-8",	             	              
		              error: function(xhr, status, error) {
		            	  alert('There was an error fetching events!');
		              }
		          }
	        });
	
	        $("#startdate").datepicker({changeMonth: true, changeYear: false, dateFormat: 'mm/dd/yy'});
	        $("#bod").datepicker({changeMonth: true, changeYear: false, dateFormat: 'mm/dd/yy'});
	    	$("#time").timeEntry({show24Hours: false, showSeconds: false, ampmPrefix: ' ', spinnerImage: ''});
	    	$("#timeend").timeEntry({show24Hours: false, showSeconds: false, ampmPrefix: ' ', spinnerImage: ''});	    	
	    	$("#time").timeEntry('setTime', 'now');
	
	    	var plus30 = new Date(); 
	    	plus30.setMinutes(plus30.getMinutes() + 60);
	    	$("#timeend").timeEntry('setTime', plus30); 
	      });
	
    </script>
    <script src="{{ asset ('js/calendar.js?' . $avoidcache)}}"></script>
    
	<style>
		.ui-widget.ui-widget-content {
		    border: 1px solid #c5c5c5;
		}
		#livesearch {
		    border: 1px solid white;
		    background: #1ABB9C;
		   
		}
		#livesearch a {    
		    font-size: 1em;
		}
		</style>
@endsection