 @extends('layouts.master') @section('content')


<div class="right_col row">


	<div class="col-md-2 col-sm-2 col-md-12">
		<div class="col-md-12">
			<a class="btn btn-app" href="{{ url('user') }}">  <i class="fa fa-users"></i> Users
			</a>
		</div>
	</div>

	<div class="col-md-2 col-sm-2 col-md-12">
		<div class="col-md-12">
			<a class="btn btn-app" href="{{ url('package') }}"> <i
				class="fa fa-gift"></i> Package
			</a>
		</div>
	</div>

	<div class="col-md-2 col-sm-2 col-md-12">
		<div class="col-md-12">
			<a class="btn btn-app" href="{{ url('service') }}"> <i
				class="fa fa-cogs"></i> Services
			</a>
		</div>
	</div>
	
	<div class="col-md-2 col-sm-2 col-md-12">
		<div class="col-md-12">
			<a class="btn btn-app" href="{{ url('inventory') }}"> <i
				class="fa fa-shopping-basket"></i> Inventory
			</a>
		</div>
	</div>

	<div class="col-md-2 col-sm-2 col-md-12">
		<div class="col-md-12">
			<a class="btn btn-app" href="{{ url('client') }}"> <i
				class="fa fa-users"></i> Client
			</a>
		</div>
	</div>

	<div class="col-md-2 col-sm-2 col-md-12">
		<div class="col-md-12">
			<a class="btn btn-app" href="{{ url('followup') }}"> 
			<!-- <span class="badge bg-green">211</span> --> 
			<i class="fa fa-book"></i> Follow
				Up
			</a>
		</div>
	</div>

	<div class="col-md-2 col-sm-2 col-md-12">
		<div class="col-md-12">
			<a class="btn btn-app" href="{{ url('appointments') }}"> 
			<i class="fa fa-calendar"></i>
				Calendar
			</a>
		</div>
	</div>

	<div class="col-md-2 col-sm-2 col-md-12">
		<div class="col-md-12">
			<a class="btn btn-app" href="{{ url('sale') }}"> <i
				class="fa fa-dollar"></i> Sales
			</a>
		</div>
	</div>
</div>

<!-- <div class="row">

	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<div class="col-md-6">
				<h2>Sales</h2>
				
				</div>
				
				<div class="col-md-6 pull-rigth">
					<div class="control-group">
	                  <div class="controls">
						  <div class="input-prepend input-group ">
							<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
							<input type="text" style="width: 200px" name="timeperiod" id="timeperiod" class="form-control" value="03/18/2013 - 03/23/2013" />
						  </div>
						</div>
					</div>	
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="x_content">
				<div class="row totals-table">
					<div class="col-sm-4">
						<div class="appointments-count value bold" >10</div>
						<span class="hint-text">Appointments</span>
					</div>
					<div
						class="col-sm-5 border-color-appointments b-l b-success b-l-thick">
						<div class="appointments-value value bold">$222.00</div>
						<span class="hint-text">Appointments value</span>
					</div>
					<div class="col-sm-3 border-color-sales b-l b-complete b-l-thick">
						<div class="sales-value value bold">$22.00</div>
						<span class="hint-text">Sales value</span>
					</div>
				</div>
				<canvas id="mybarChart"></canvas>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Today's Appointments</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content" id="todayappointment">
				
			</div>
		</div>
	</div>
	
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>TOP SERVICES</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content" id="topservices">
				
			</div>
		</div>
	</div>
	
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>TOP STAFF</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content" id="topstaff">
				
			</div>
		</div>
	</div>
	
	<div class="col-md-6 col-sm-6 col-xs-12" id="pendingpaymentsdiv">
		<div class="x_panel">
			<div class="x_title">
				<h2>Pending Payments</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content" id="pendingpayments">
				
			</div>
		</div>
	</div>
	
	<div class="col-md-6 col-sm-6 col-xs-12" id="followupsdiv">
		<div class="x_panel">
			<div class="x_title">
				<h2>Today's Follow Ups</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content" id="pendingfollowup">
				
			</div>
		</div>
	</div>
	


<input type="hidden" id="startdate">
<input type="hidden" id="enddate">
</div> -->

          

<script src="{{ asset ('vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset ('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- morris.js -->
<script src="{{ asset ('vendors/raphael/raphael.min.js')}}"></script>
<script src="{{ asset ('vendors/Chart.js/dist/Chart.min.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset ('js/moment/moment.min.js')}}"></script>
<script src="{{ asset ('js/datepicker/daterangepicker.js')}}"></script>

<script>
      $(document).ready(function() {
        $('#timeperiod').daterangepicker(null, function(start, end, label) {
        	getIndicators();
        });

        //$('#startdate').val(moment.now());
        //$('#enddate').val(moment.now());
      });
    </script>    

<?php $avoidcache = time(); ?>
		
	<script src="{{ asset ('js/ajax-functions.js?' . $avoidcache)}}" type="text/javascript"></script>
	
<script>
	function getIndicators()
	{
		getAppointmentSale();
		getTodayAppointment();
		getTopServices();
		getTopUsers();
		getPendingPayments();
	}
</script>

@endsection
