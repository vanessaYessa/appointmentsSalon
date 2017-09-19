

@extends('layouts.master')

@section('content')

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>
						Today's appointments <small></small>
					</h2>
					<ul class="nav navbar-right panel_toolbox"> 
						<li><a class="close-link" href="{{ url(Session::get('init_page'))}}"><i class="fa fa-close"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">	
					<button style="display: none" type="button" id="createApp" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Create Appoitment</button>
					<div class="col-md-12">
						<!-- THE CALENDAR -->
						<div id="calendar"></div>
						<!-- /. box -->
					</div>
				</div>
			</div>
		</div>
	</div>
				

<!-- Modal to Create Appoitment -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Create Appointment</h4>
			</div>
			
			<div class="modal-body ">	
				{!! Form::open(array('action' => 'AppointmentController@store', 'class' => 'form-horizontal', 'id' => 'createAppoitment')) !!}
				{!! Form::hidden('appointmentId',  null, ['id' => 'appointmentId']) !!}
				{!! Form::hidden('source',  $source ) !!}
				<div class="form-group">
					<div class="col-md-6" id="titleDiv">
	                	{!! Form::text('title', null,  ['class'=> 'form-control', 'placeholder' => 'Title', 'id' => 'title']) !!}
	                </div>	
	               <div class="col-md-6" id="resourceDiv"> 
		            	{!!Form::select('associateId', $associates, null, ['class'=> 'form-control', 'id' => 'associateId'])!!}
		            </div>
				</div>
				
               
               <div class="form-group">
               		<div class="col-md-6" id="dateDiv">
	                   <div class="input-group2">
			               	<div class="input-group-addon">
			                	<i class="fa fa-calendar"></i>
			                </div>
		                     {!! Form::text('startdate',  null, ['id' => 'startdate', 'class'=>
							'form-control2', 'placeholder' => 'Date *', 'style' => 'width: 120px;', 'onChange' => 'document.getElementById("enddate").value = this.value']) !!}
							 <!-- - -->
							 {!! Form::hidden('enddate',  null, ['id' => 'enddate', 'class'=>
							'form-control2', 'placeholder' => 'Date *', 'style' => 'width: 100px;']) !!}
		                </div>
					</div>
					
					
					<div class="col-md-6" id="timeStartDiv">											                    
						<div class="input-group2">
	                       <div class="input-group-addon">
	                          <i class="fa fa-clock-o"></i>
	                        </div>
	                        {!! Form::text('time',  null, ['id' => 'time', 'class'=>
								'form-control2', 'placeholder' => 'Time end *', 'style' => 'width: 90px;', 'onchange' => 'setEndTime(this.value);']) !!}
							&nbsp; - &nbsp;	
							  {!! Form::text('timeend',  null, ['id' => 'timeend', 'class'=> 'form-control2', 'placeholder' => 'Time end *', 'style' => 'width: 90px;']) !!}	                       
	                    </div>				                
		            </div>
               </div>
               
               <div class="form-group">
		            <div class="col-md-6">
	                   	{!! Form::textarea('comments',  null, ['id' => 'comments', 'id' => 'comments', 'class'=> 'form-control', 'placeholder' => 'Appointment Comments', 'rows' => "8"]) !!}
	                </div>
		            
		            <div class="col-md-6" id="locationDiv">
	                  	{!!Form::select('locationId', $locations, null, ['class'=> 'form-control', 'id' => 'locationId', 'onchange' => 'setTitle();'], array('a016_id', 'a016_name'))!!} <br/>
	                </div>
	                
	                <div class="col-md-6" id="prospectDiv">
						{!! Form::text('prospect', null, ['id' => 'prospect', 'class'=>
						'form-control ', 'placeholder' => 'Prospect Name ', 'onkeyup' => 'if(this.value.length > 2) getProspectList(this.value);']) !!}
						{!! Form::hidden('prospectId',  null, ['id' => 'prospectId']) !!}
						<div id="livesearch"></div> <br>
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
						        $('#myModal').modal('show');
						    });
						 </script>
					@endif
				
				<div id="idddd"  style="display: none">
					<hr/>
					
					<span class="activity-img">Prospect status:</span>
					<div class="form-group">
	                    <div class="col-sm-6">
	                    	{!! Form::select('statustype', $statusType, null, ['class' => 'form-control', 'id' => 'statustype', 'onchange' => 'getStatusByType(this.value)']) !!}
	                    </div>
	                    
	                    <div class="col-sm-5">
	                    	{!! Form::select('status', ["Select status "], null, ['class' => 'form-control', 'id' => 'status']) !!}
	                    </div>
	                </div>
	                
                
                
					<span class="activity-img">Appointment result:</span>
					<div class="form-group"  >
	                    <div class="col-md-6">
		                   	{!! Form::textarea('commentsresult',  null, ['id' => 'commentsresult', 'class'=> 'form-control', 'placeholder' => 'Comments after appointment', 'rows' => "3"]) !!}
		                </div>
		                <div class="col-md-6" id="resourceDiv"> 
			            	{!!Form::select('statusId', $status, null, ['class'=> 'form-control', 'id' => 'statusId'])!!}
			            </div>	
					</div>
					
					<div class="form-group"  >
					 	<div class="col-md-6 activity-img">
		                    <span id="createdOn"></span> 
	                    </div>	
	                    
					</div>		
				</div>
				
			</div> 
			<div class="modal-footer">
				<button id="deleteButton" style="float: left; display: none;" type="button" class="btn btn-danger" data-dismiss="modal" onclick="return multiply();" >Delete</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit('Add', ['class'=> 'btn btn-primary btn-flat', 'id'=> 'add-new-event']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>




<div class="modal fade" id="puConfirmD" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">X</button>
				<h5 class="modal-title" id="myModalLabel">
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

<!-- I will do it on my end now. Please bear with me.-->


<!-- fullCalendar 2.2.5-->
	
    <link rel="stylesheet" href="{{ asset ('js/fullcalendar/fullcalendar.min.css')}}" type='text/css' />
    <link rel="stylesheet" href="{{ asset ('js/fullcalendar/fullcalendar.print.css')}}" type='text/css' media='print'  />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />   
<!-- Bootstrap time Picker -->
	<script src="{{ asset ('js/time/jquery.plugin.js')}}"></script>
	<script src="{{ asset ('js/time/jquery.timeentry.js')}}"></script>
	<link href="{{ asset ('js/time/jquery.timeentry.css')}}" rel='stylesheet' />   

    
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset ('ui/js/moment/moment.min.js')}}"></script>
    <script src="{{ asset ('js/fullcalendar/fullcalendar.min.js')}}"></script>

     
    <!-- CALENDAR -->
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

	<style>
		<!--
		.fc-time span, .fc-title{
			font-size: 14px;
		}
		.fc-widget-content, .fc-today
		{
			background-color: white;
		}		
		.fc-content
		{
			border-color: aqua;
		}
		-->
	</style>
    <!-- Page script -->
    <script type="text/javascript"  >

		function multiply(campaign) {			
 		    document.getElementById("confirmName").innerHTML = $('#prospect').val() + " "  + $('#startdate').val();
 		   	$('#puConfirmD').modal();
 		}

	    function deleteAppointment() {			
 		    document.location.href = localhost + "/appointment/delete/" + $('#appointmentId').val();
 		}

	    $(function () {

	        $('[data-toggle="tooltip"]').tooltip();
	        
	        /* initialize the calendar
	         -----------------------------------------------------------------*/
	        $('#calendar').fullCalendar({
	        	defaultDate: moment(),
				defaultView: 'agendaDay',
			  header: {
	            left: '',
	            center: 'title',
	            right: ''            
	          },
	          buttonText: {
	            today: 'today',
	            month: '',
	            week: '',
	            day: ''
	          },

	          
	          allDaySlot: false,
	
	          dayClick: function(date, jsEvent, view) {
	              $('#startdate').datepicker('setDate', date.format('MM/DD/YYYY'));
	              $('#enddate').datepicker('setDate', date.format('MM/DD/YYYY'));
	         	  clearForm();
	             
	              $('#createApp').trigger('click');              
	          },
	          eventClick: function(calEvent, jsEvent, view) {
	              $.ajax({
	                  url: localhost + '/getAppointment',	                
	                  type: "GET",
	                  cache: false,
	                  data: { 
	                	  id: calEvent.id
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
	          droppable: false, // this allows things to be dropped onto the calendar !!!
	          events:  {
	        	  url: localhost + '/getAppointmentsToday',
	              type: 'GET',
	              cache: false,
	              data: { 
                	  userId: {!! $userId !!}
                  },
	              dataType: "json",
	              headers : {'Content-Type':'application/json; charset=utf-8',
	            	  'Authorization':'Basic xxxxxxxxxxxxx',
	                  'X_CSRF_TOKEN':'{{ csrf_token() }}',
	      			},
	              contentType: "application/json; charset=utf-8",
	              success: function() {
	            	  getCalendarResumen();
	              },
	              error: function(xhr, status, error) {
	            	  alert(xhr + " " + status + " " + error );
	            	  alert('there was an error fetching events!');
	              }
	          }/*,viewRender: function () { 
	        	  getCalendarResumen();
	          }*/
	        });
	
	        $("#startdate" ).datepicker({changeMonth: true, changeYear: false, dateFormat: 'mm/dd/yy'});
	        $("#enddate" ).datepicker({changeMonth: true, changeYear: false, dateFormat: 'mm/dd/yy'});
	    	$("#time").timeEntry({show24Hours: false, showSeconds: false, ampmPrefix: ' ', spinnerImage: ''});
	    	$("#timeend").timeEntry({show24Hours: false, showSeconds: false, ampmPrefix: ' ', spinnerImage: ''});
	    	$('#startdate').datepicker('setDate', 'today');
	    	$('#enddate').datepicker('setDate', 'today');
	    	$("#time").timeEntry('setTime', 'now');
	
	    	var plus30 = new Date(); 
	    	plus30.setMinutes(plus30.getMinutes() + 60);
	    	$("#timeend").timeEntry('setTime', plus30); 
	      });
	
	    function clearForm()
	    {
	    	$('#myModalLabel').html('Create Appointment');
            $('#idddd').css({"display": "none"});
             
	    	$('#title').val("");
	  	 	
	  	  	$("#time").timeEntry('setTime', 'now');

	  	  	$('#prospect').val("");
	  	  	$('#prospectId').val("");	
	  	 	$('#locationId').val("");
	  	 	$('#appointmentId').val("");
	  	  	$('#associateId').val( {{ Session::get('active_user')['a104_id'] }});	
	  	  	$('#comments').val("");
	  	  	$('#statusId').val(0);
	  	  	$('#livesearch').html("");
	
	  	  	$('#myModalLabel').html('Create Appointment')
	  	  	$('#add-new-event').html('Add');
	  	  	$('#commentsresult').val("");
	  	  	$('#idddd').css({"display": "none"});
	  	 	$('#deleteButton').css({"display": "none"});
	    }	    

    </script>
    
    
    <script src="{{ asset ('js/calendar.js')}}"></script>
 
    
@endsection