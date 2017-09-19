
@extends('layouts.master')

@section('content')


<div class="right_col" role="main">
	
	 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             Appointments <small id="username"></small>
          </h1>
     	</section>

        <!-- Main content -->
			<section class="content">
				<button style="display: none" type="button" id="createApp" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Create Appoitment</button>
					
					<div class="pull-right" style="float:right">
						@foreach( $userlist as $user )   
							<div id="" onclick='showCalendarByUser( {{ $user->a01_id }} );'
							style="float: left;width: 70px; height: 20px; background-color:{{ $user->a01_calendarcolor }}; color: white">
							&nbsp;{{ $user->a01_username }}</div>
	                	@endforeach
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
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="min-width: 900px !important">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Create Appointment</h4>
				</div>
			
			<div class="modal-body ">	
				{!! Form::open(array('action' => 'AppointmentController@storeMassive', 'class' => 'form-horizontal', 'id' => 'createAppoitment', 'data-parsley-validate')) !!}
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
					
					
				 <div class="row">
              		<div class="col-md-6 col-xs-12">
              			<div class="input-group input-group-sm" id="dateDiv"> 
							<label class="input-group-addon" for="dataScaleX"><i class="fa fa-calendar"></i></label>
							{!! Form::text('startdate', null, ['class'=> 'form-control', 'id' => 'startdate', 'onChange' => 'document.getElementById("enddate").value = this.value']) !!}
							{!! Form::hidden('enddate',  null, ['id' => 'enddate']) !!}
						 </div>
              		</div>
              		
              		<div class="col-md-6 col-xs-12">
              			<div class="input-group input-group-sm" id="timeStartDiv">
							<div class="input-group-addon">
							  <i class="fa fa-clock-o"></i>								  
							</div>
							{!! Form::text('time',  null, ['id' => 'time', 'class'=>
								'form-control', 'placeholder' => 'Time end *', 'style' => 'width: 100px;']) !!}								 
						</div>
              		</div>
              	</div>
         
              	
              	<div class="row">
              		<div class="col-md-6 col-xs-12">
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
              		
              		<div class="col-md-6 col-xs-12">
              			<div class="x_panel_cal">
		                  <div class="x_content_cal">
		                  
		                  	<div class="col-md-12" >
		                  		<label for="">Selected Service</label>              			
			                  		<table style="width: 100%" class="table table-border" id="finaltable">
				               			<tr>
				               				<td>Service</td>
				               				<td>Stylist</td>
				               				<td>Time</td>
				               				<td></td>
				               			</tr>
				               		</table>
		                  	</div>
		                  </div>
		                </div>
		            </div>
		                
		           
              		
              	</div>
              	
              	
              	<div class="row">
              		<div class="col-md-12 col-xs-12">
              			<div class="x_panel">
		                  <div class="x_title">
		                    <h2>Customer information </h2>   
		                    <label id="lastvisit"></label>                 
		                    <div class="clearfix"></div>
		                  </div>
		                  <div class="x_content">
		                  
		                  	<div class="col-md-6 col-xs-12">
		                  		<div class="x_panel">
		                  			
		                  			<div class="col-md-6 col-xs-12">
		                  				<label for="fullname">Name * :</label>                      	
				                      	{!! Form::text('client', null, ['id' => 'name', 'class'=> 'form-control ', 'autocomplete' => 'off']) !!}
										
										{!! Form::hidden('clientid',  null, ['id' => 'clientid']) !!}
										
										<label>Phone number *:</label>
			                   			{!! Form::text('phone', null, ['id' => 'phone', 'class'=> 'form-control', 'autocomplete' => 'off' ]) !!}
			                   			
			                   			
				                   		<label for="email">Email:</label>
				                      	<input type="email" id="email" class="form-control" name="email" data-parsley-trigger="change" required />
				                    </div>
		                  			
		                  			<div class="col-md-6 col-xs-12">
		                  				<label for="fullname">Lastname * :</label>                      	
			                      		<input type="text" id="lastname" class="form-control" name="fullname" required />
			                      		
			                      		<label>BOD:</label>
			                   			{!! Form::text('bod', null, ['id' => 'bod', 'class'=> 'form-control' ]) !!}
			                   			
			                   			<label>Gender:</label>
				                   		<div class="inline-form">
											{!!Form::radio('gender', 1, true, ['class'=> ''])!!} Female&nbsp;&nbsp;&nbsp;
											{!!Form::radio('gender', 2, false,  ['class'=> ''])!!} Male 
										</div>
										
										
										<div class="actionBar">			                   		
				                   			<button id="addButton" type="button" class="btn btn-danger" onclick="getProspectList();" ><i class='fa fa-search'></i> Search</button>
				                   		</div>
		                  			</div>
								</div>
			               	 </div>
		              			
		              		
		              		<div class="col-md-6 col-xs-12">
		              			<div id="customeralert" class="">
		              				<div id="livesearch">
		              					
		              				</div>
		              			</div>
		              		</div>  
		              		 
		                  </div>
		                </div>
              		</div>
              	</div>
              	
              	<div class="row">
              		<div class="col-md-12 col-xs-12">
            			{!! Form::textarea('comments',  null, ['id' => 'comments', 'id' => 'comments', 'class'=> 'form-control', 'placeholder' => 'Appointment Comments', 'rows' => "5"]) !!}
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
						        $('#myModal').modal('show');
						    });
						 </script>
					@endif
				
				
				<div class="row" id="afterdate" style="display:none;"  >
              		<div class="col-md-6 col-xs-12" >
            			{!! Form::select('statusid', $status, null, ['class' => 'form-control', 'id' => 'statusid']) !!}
            			
            			<span id="createdOn"></span> 
              		</div>
              		
              		<div class="col-md-6 col-xs-12" >
              			{!! Form::textarea('commentsresult',  null, ['id' => 'commentsresult', 'class'=> 'form-control', 'placeholder' => 'Comments after appointment', 'rows' => "3"]) !!}
              				                    
              		</div>
              	</div>
              	
			</div> 
			<div class="modal-footer">
				<button id="deleteButton" style="float: left; display: none;" type="button" class="btn btn-danger" data-dismiss="modal" onclick="return multiply();" >Delete</button>
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

	<script src="{{ asset ('js/ajax-functions.js')}}"></script>
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
	
    <!-- Page script -->
    <script type="text/javascript"  >

		function deleteAppointment() { alert(localhost + "/appointment/delete/" + $('#appointmentid').val());
 		    document.location.href = localhost + "/appointment/delete/" + $('#appointmentid').val();
 		}

  		
	    $(function () {

		    $("#phone").mask("(999) 999-9999");
	    	
    		$('.carousel2').slick({
  	  		  slidesToShow: 4,
  	  		  slidesToScroll: 1,
  	  		  autoplay: true,
    		  adaptiveHeight: true,
  	  		  autoplaySpeed: 4000,
  	  		  cssEase: 'linear'
  	  		});

	    	$('.carousel').slick({
    		  slidesToShow: 4,
    		  slidesToScroll: 1,
    		  autoplay: true,
    		  adaptiveHeight: true,
    		  autoplaySpeed: 4000,
    		  cssEase: 'linear'
    		});

	    	
	    	 $('#my-select').searchableOptionList( {
	 			texts: { searchplaceholder: 'Select service *'}, 
	 			showSelectionBelowList: false 
	 		 });
	        /* initialize the calendar
	         -----------------------------------------------------------------*/
	        $('#calendar').fullCalendar({
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
	        	  $("#startdate" ).datepicker('setDate', date.format('MM/DD/YYYY'));
	        	  $("#enddate" ).datepicker('setDate', date.format('MM/DD/YYYY'));
	        	  $("#startdate").datepicker({changeMonth: true, changeYear: false, dateFormat: 'mm/dd/yy'});
	              //clearForm();	    
	         	  $('.modal-dialog').css('width', '900px');          
	              $('#myModal').modal('show');              
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
	        	  url:  localhost + 'appsByUser',
	              type: 'GET',
	              cache: false,
                  data: { 
                	  userid: {{ $calendaruserid }}
                  },
                  success: function(result) {
                	  $("#username").html(" - " + result[0].username); 
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
	
	    function clearForm()
	    {
  	  		
	        $('#afterdate').css({"display": "none"});
        	$('#title').val("");
	  	  	$('#client').val("");
	  	  	$('#clientid').val("");	
	  	 	$('#appointmentid').val("");
//	  	  	$('#userid').val( {{ Session::get('active_user')['a104_id'] }});	
	  	  	$('#comments').val("");
	  	  	$('#phone').val("");
		  	$('#statusid').val(1); 
	  	  	$('#livesearch').html("");
	  	  	$("#time").timeEntry('setTime', 'now');
	  	  	$('#myModalLabel').html('Create Appointment');
	  	  	$('#add-new-event').val('Add');
	  	  	$('#commentsresult').val("");
	  	 	$('#deleteButton').css({"display": "none"});
	    }	    

    </script>
    
    
    <script src="{{ asset ('js/calendar.js')}}"></script>
	
	
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