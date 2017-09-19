
@extends('layouts.master')

@section('content')
	
	<!-- page content -->
    <div class="" role="main">
    	{!! Form::open(array('action' => 'DashboardController@index2', 'class' => 'form-horizontal')) !!}
  		{!! Form::hidden('associateId', null, ['id'=> 'associateId']) !!}
  		{!! Form::hidden('realassociateId', Session::get('active_user')['a102_id'] , ['id'=> 'realassociateId']) !!}
  		{!! Form::hidden('username', null, ['id'=> 'username']) !!}
		{!! Form::hidden('startDate', 'undefined', ['id'=> 'startDate']) !!}		
        {!! Form::hidden('endDate', 'undefined', ['id'=> 'endDate']) !!}    
    </div>
    
    <!-- marquee content -->
	<div class="row" style="display:none ">
		<div class="col-md-12 x_panel_noborder">
			<div id="marquee" class="demo-placeholder" style="height: 20px">
				<marquee><p style="font-family: Impact; font-size: 10pt">
					Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor 
					Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor!</p>
				</marquee>
			</div>
		</div>
	</div>
	<!-- /marquee content -->
     
    
     <div class=" main_container">
			<!-- row  -->		
			<div class="row">
              <div class="col-md-12">
                <div class="x_panel col-md-12">
                    <!-- /row  -->          
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
						<div class="col-md-1" onclick='getTransactionGoals( -1, document.getElementById("startDate").value, document.getElementById("endDate").value, "COLAMERICA");getTodayActivity(-1);'>
                          	<img class="img-circle" width="40" src="./ui/images/colamerica-logo.png" style="width: 45px; height: 45px;" alt="" onclick='getTransactionGoals( -1, document.getElementById("startDate").value, document.getElementById("endDate").value, "COLAMERICA");> 
                            <a href="#" style="color: #800000" onclick='getTransactionGoals( -1, document.getElementById("startDate").value, document.getElementById("endDate").value, "COLAMERICA");getTodayActivity(-1);' ><b>Colamerica</b></a>
                        </div>
						
	              		@foreach($assistedAssociates as $associateCom) 
                        <div class="col-md-1" onclick='getTransactionGoals( {!! $associateCom->a102_id!!}, document.getElementById("startDate").value, document.getElementById("endDate").value, "{!! $associateCom->a102_username!!}");getTodayActivity({!! $associateCom->a102_id!!});'>
                         	@if($associateCom->a104_image != "")
							<img class="img-circle" width="45px" height="45px" src="images/associate/{!!$associateCom->a104_image!!}" style="width: 45px; height: 45px;" 
							alt="" onclick='getTransactionGoals( {!! $associateCom->a102_id!!}, document.getElementById("startDate").value, document.getElementById("endDate").value, "{!! $associateCom->a102_username!!}");getTodayActivity({!! $associateCom->a102_id!!});'>
						@endif 
	                	<p>{!! $associateCom->a102_username!!}</p>
	                </div>		                     
                    @endforeach
                	</div>
            	</div> 
			<!-- /row  -->		
		</div>		 
    </div>
    <!-- /container -->
     <div class="row">

		<!-- my results column -->
		<div class="col-sm-5" style="display:none" id="transactions">
			<div class="x_panel tile">
				<div class=" center col-xs-12">
					<p style="font-size: large; text-align: center;">
						<strong id="resultsTo"> </strong>
					</p>
				</div>
				<div class="col-md-12" id="reportrange"
					style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
					<i class="glyphicon glyphicon-calendar fa fa-calendar"></i> <span></span>
					<b class="caret"></b>
				</div>
			
				<div class="col-xs-12 ">
					<div class=" col-xs-12 col-sm-12 tile_count" id="goals"></div>
				</div>
			</div>
		</div>
		<!-- /my results column -->
		
		<!-- todays conditions -->
		<div class="col-md-3 col-sm-6 col-xs-12" id="conditions" style="display:">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Today Conditions</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width: 20px !important">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table class="" style="width: 80%" id="todaysCondition"></table>
                  </div>
                </div>
              </div>
		<!-- /todays conditions -->
		
		<!-- todays files -->
			<div class="col-md-4 col-sm-6 col-xs-12" id="todaysfile"
				style="display:">
				<div class="x_panel">
					<div class="x_title">
						<h2>
							Today's Files <small></small>
						</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>

							<li><a class="close-link"><i class="fa fa-close"></i></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table class="" style="width: 80%">
							<tr>
								<td style="text-align: left !important;"><b>LOANS TO BE OPEN</b>
									<UL>
										<LI></LI>
									</UL></td>
							</tr>
							<tr>
								<td style="text-align: left !important;"><b>LOANS WITH
										CONDITIONS</b>
									<UL>
										<LI></LI>
									</UL></td>
							</tr>
							<tr>
								<td style="text-align: left !important;"><b>LOANS TO REVIEW FOR
										APPROBAL</b>
									<UL>
										<LI></LI>
									</UL></td>
							</tr>
							<tr>
								<td style="text-align: left !important;"><b>LOANS TO REVIEW FOR
										CTC</b>
									<UL>
										<LI></LI>
									</UL></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<!--  -->
		<!-- /todays files -->

		<!----
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile">
                <div class="x_title">
                  <h2>Weekly Goals</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4>App Usage across versions</h4>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.2</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>123k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.3</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>53k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.4</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>23k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.5</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>3k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.6</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>1k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
        <!--  -->

                </div>
              </div>
            </div>


          </div>
    

	</div>
	
	
   
</div>

    


    <!-- bootstrap-daterangepicker -->
    <script type="text/javascript">

    function redirect(url)
    {
    	var associateId = document.getElementById("associateId").value;
    	location.href= url + '/' + associateId;
    }
    function init()
    {
  	  $('#reportrange span').html(moment().startOf('month').format('MM/DD/YYYY') + ' - ' + moment().format('MM/DD/YYYY'));
    }

      $(document).ready(function() {
          
          var cb = function(start, end, label) {
              console.log(start.toISOString(), end.toISOString(), label);
            };

          var optionSet1 = {
              startDate: moment().startOf('month'),
             // startDate: moment(),
              endDate: moment(),
              opens: 'right',
              buttonClasses: ['btn btn-default'],
              applyClass: 'btn-small btn-primary',
              cancelClass: 'btn-small',
              format: 'MM/DD/YYYY',
              locale: {
                applyLabel: 'Select',
                cancelLabel: 'Clear',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
              }
            };

          
           $('#reportrange span').html(moment().startOf('month').format('MM/DD/YYYY') + ' - ' + moment().format('MM/DD/YYYY'));
           $('#reportrange').daterangepicker(optionSet1, cb);        
           $('#reportrange').on('apply.daterangepicker', function(ev, picker){
	      	    $('#reportrange span').html(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
	      	  	$('#startDate').val(picker.startDate.format('YYYY/MM/DD')); 
		        $('#endDate').val(picker.endDate.format('YYYY/MM/DD'));
		        getTransactionGoals( document.getElementById("associateId").value, document.getElementById("startDate").value, document.getElementById("endDate").value, document.getElementById("username").value);
        	});
      	});
      init();      

      getTransactionGoals( document.getElementById("associateId").value, document.getElementById("startDate").value, document.getElementById("endDate").value, "COLAMERICA");
      getTodaysConditions( {!! Session::get('active_user')['a102_id'] !!});
    </script>
    <!-- /bootstrap-daterangepicker -->
    {!! Form::close() !!}

@endsection