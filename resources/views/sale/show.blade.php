@extends('layouts.master')

@section('content')


<!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="{{ asset ('js/fullcalendar/fullcalendar.min.css')}}" type='text/css' />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

	 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h2>Invoice <small></small></h2>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                          	<i class="fa fa-globe"></i> Invoice
                            <small class="pull-right">Date: {!!App\Util::getStringFormat2($sale->a07_date)!!}</small>
                          </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       	<?php 
				        $client = $sale->client;
				        ?>
                        <div class="col-sm-4 invoice-col">
                          To
                          <address>
                            <strong>{!! $client->a05_name !!} @if($client->a05_lastname != null) {!! $client->a05_lastname !!} @endif</strong>
                            <br>Phone: {{ phone_format($client->a05_mobile, 'US', 2)}}  
                            <br>Email: {!!$client->a05_email !!}
						  </address>  
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Invoice #007612</b>
                          <br>
                          <b>Status:</b> {{ App\Util::getInvoiceStatus()[$sale->a07_status] }}
                          <br>
                          <b>Payment Date:</b> 2/22/2014
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped table-bordered display">
                            <thead>
                              <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Serial #</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody> 
                            <?php 
                            	$total = 0;
                            ?>
                              @for ($i = 0; $i < count($sale->details); $i++)
                              <?php 
                            	$detail = $sale->details[$i];
                            	
                            	?>
                              
                              <tr>
                                <td>{!! $detail->a08_quantity !!}</td>
                                <td>
                                	
                                	@if($detail->service[0])
                                		{!!  $detail->service[0]['a02_name'] !!}
                                	@else
                                		{!! $detail->inventory[0]['a15_name'] !!}
                                	@endif
                                </td>
                                <td></td>
                                <td>${!!$detail->a08_price !!}</td>
                              </tr>
                              <?php 
                            	$total += $detail->a08_price;
                              ?>
                              @endfor
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                        	@if( $sale->a07_comment != "")
								<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
		                            {!! $sale->a07_comment !!}
		                          </p>
                            @endif
                            
                            @if( count($sale->payments) > 0 )
                            <h4><b>Payments </b></h4>
                            <table class="table table-striped table-bordered display">
                            <thead>
                              <tr>
                                <th style="width: auto;">Amount</th>
                                <th style="width: 60px;">Date</th>
                                <th style="width: auto;">User</th>
                                <th style="width: auto;">Comments</th>
                                <th></th> 
                              </tr>
                            </thead>
                            <tbody> 
                              @for ($i = 0; $i < count($sale->payments); $i++)
                              <?php 
                            	$payment = $sale->payments[$i];
                            	?>
                              <tr>
                                <td>${!! $payment->a16_amount !!}</td>
                                <td>{!! \App\Util::getBOD($payment->a16_date) !!} </td>
                                <td>{!! $payment->user->a01_username !!} </td>
                                <td> {!! $payment->a16_comment  !!}</td>
                                <td>
                                	<button id='changePayment' type='button' class='btn btn-warning' onclick="editPayment({!! $payment->a16_amount!!},'{!! $payment->a16_comment!!}', {!! $payment->user->a01_id !!}, '{!! \App\Util::getStringFormat3($payment->a16_date) !!}', {!! $payment->a16_id !!})" ><i class='fa fa-edit'></i></button>
                                	
                                	{!!Form::open(array('action' => array('SaleController@destroyPayment', $payment->a16_id), 'method' => 'POST', 'id'=>'form'.$payment->a16_id)) !!}
										<button id='deletePayment' type='button' class='btn btn-danger' onclick="return confirmDelete('{!! \App\Util::getBOD($payment->a16_date) !!} for ${!! $payment->a16_amount!!}', {{ $payment->a16_id}});" ><i class='fa fa-trash-o'></i></button>
									{!! Form::close() !!}
                                	
                                </td>
                              </tr>
                              @endfor
                            </tbody>
                          </table> <br/>
                          @endif
                          
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <div class="">
                            <table class="table table-striped table-bordered display">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Tip:</th>
                                  <td>${!! $sale->a07_tip !!}</td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td>${!! $total !!}</td>
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                        	<button class="btn-info btn" onclick="$('#myModal').modal();">Add Payment</button>
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          
                          <button class="btn btn-default" onclick="history.back();"><i class="fa fa-arrow"></i> Go Back</button>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
           
          </div>
        </div>
        <!-- /page content -->
        
    
	
	<!-- Payment info -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">X</button>
					<h5 class="modal-title" id="myModalLabel">
						<b><span>
							<i class="fa fa-dollar"></i>
						</span> 
						 <span id="teamName">Add payment</span></b>
					</h5>
				</div>
				{!! Form::open(array('action' => 'SaleController@storePayment', 'class' => 'form-horizontal')) !!}
					
				<div class="modal-body">
					
					{!!Form::hidden('paymentid', null, [ 'id' => 'paymentid'])!!}
					{!!Form::hidden('saleid', $sale->a07_id, [ 'id' => 'saleid'])!!}
					<div class="row">
						
						<div class="col-md-6">
							 <label class="">Date:</label>
							  {!! Form::text('date', null,  ['class'=> 'form-control', 'style' =>'width: 120px;', 'id' => 'date']) !!}
						</div>
						
						<div class="col-md-6">
							<label class="">Amount:</label>
							  {!! Form::text('amount', null,  ['class'=> 'form-control', 'style' =>'width: 120px;', 'id' => 'amount']) !!}</label>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<label>Received by:</label>	
							{!!Form::select('userid', $users, null, ['class'=> 'form-control', 'id' => 'userid'])!!}
						</div>
						
						<div class="col-md-6">
							<label>Comments</label>	
							{!! Form::textarea('comment', null,  ['id'=> 'comments', 'class'=> 'form-control',  'cols'=> '5', 'rows' => '3']) !!}
						</div>
						
					</div>
				
				</div>
				
				<div class="modal-footer">
					<div id="delmodelcontainer" style="float: right">
						<div id="yes" style="float: left; padding-right: 10px">
						{!!Form::submit('Submit', array('class' => 'btn btn-primary'))!!} 
						</div>
						<div id="no" style="float: left;">
							<button type="button" class="btn btn-defualt" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- end delmodelcontainer -->
				</div>
				{!! Form::close() !!}
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
	
<?php $avoidcache = time(); ?>
		
	 <!-- jQuery -->
    <script src="{{ asset ('vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset ('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset ('js/ajax-functions.js?' . $avoidcache)}}" type="text/javascript"></script>
	
	<!-- fullCalendar 2.2.5 -->
    <script src="{{ asset ('js/moment/moment.min.js')}}"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script src="{{ asset ('js/fullcalendar/fullcalendar.min.js')}}"></script>
    
    <script>
    jQuery(function($){
       $("#date").datepicker({changeMonth: true, changeYear: false, dateFormat: 'mm/dd/yy'});
    });

    function editPayment(amount, comments, userid, date, paymentid)
    {
    	 $("#paymentid").val(paymentid);
    	 $("#amount").val(amount);
    	 $("#comments").val(comments);
    	 $("#userid").val(userid);
    	 $("#date").val(date);
    	 $("#teamName").val("Edit paymnent");
    	 $('#myModal').modal();
    }

	var teamId;
	
	function confirmDelete(team, id) {			
	    document.getElementById("datedelete").innerHTML =team;
	    teamId = id;
	    $('#confirmModal').modal();
	}

    function sendSubmit() {	
		document.getElementById("form"+teamId).submit();
	}
	</script>
	
	
	<!-- Confirm delete team -->
	<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">X</button>
					<h5 class="modal-title" id="myModalLabel">
						<b><span style="color: red;" class="glyphicon glyphicon-warning-sign">
						</span>  &nbsp;
						 <span id="teamName">Delete payment</span></b>
					</h5>
				</div>
				
				<div class="modal-body">
					<h5 class="modal-title" id="myModalLabel">
						<b>
						Are you sure you want to delete the payment on  <span id="datedelete"></span>?</b>
					</h5>
				</div>
				<div class="modal-footer">
					<div id="delmodelcontainer" style="float: right">
						<div id="yes" style="float: left; padding-right: 10px">
						{!!Form::submit('Yes, delete', array('class' => 'btn btn-primary', 'onclick' => 'sendSubmit();'))!!} 
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
	<!-- /.modal -->
	        
	
	
	@endsection 