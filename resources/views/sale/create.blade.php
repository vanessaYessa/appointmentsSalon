 @extends('layouts.master') 
 
 @section('content')

<div class="right_col" role="main">
	<div class="">

		<div class="row">
			<div class="col-md-10 col-xs-12">

				<div class="x_panel">
					<div class="x_title">
						<h2>
							Create new sale <small></small>
						</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
					<!-- start form for validation -->						 
						 {!! Form::open(array('action' => 'SaleController@store', 'class' => 'form-horizontal', 'novalidate')) !!} 
							{!! Form::hidden('saleid',  $sale->a05_id ) !!}
							{!! Form::hidden('clientid',  null, ['id'=> 'clientid']  ) !!}
							
							<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  	<section class="content invoice">
                      
                      <!-- info row -->
                      <div class="row invoice-info">
				                  
                  		<div class="col-md-12 col-xs-12" id="newclient">
	                  		<div class="">
	                  			<div class="col-md-2 col-xs-12">
	                  				<label for="fullname">Name * :</label>                      	
			                      	{!! Form::text('name', null, ['id' => 'name', 'class'=> 'form-control ', 'autocomplete' => 'off']) !!}
								  </div>
	                  			
	                  			<div class="col-md-2 col-xs-12">
	                  				<label for="fullname">Lastname :</label>                      	
		                      		<input type="text" id="lastname" class="form-control" name="fullname"  />
		                      		
								</div>
	                  			
	                  			<div class="col-md-2 col-xs-12">	
									<label>Mobile *:</label>
		                   			{!! Form::text('phone', null, ['id' => 'phone', 'class'=> 'form-control', 'autocomplete' => 'off' ]) !!}
		                   		</div>
		                   		
	                  			<div class="col-md-4 col-xs-12">	
									<br/>	<button type="button" class="btn " onclick="addClient();" ><i class='fa fa-plus'></i> Add Client </button>
			                   		<button type="button" class="btn btn-danger" onclick="getProspectList(2);" ><i class='fa fa-search'></i> Search</button>
			                   	</div>
							</div>
		               	 </div>
		               	 
		               	 <div class="col-md-12 col-xs-12" id="oldclient" style="display: none">
		               	 	<div class="col-sm-3 invoice-col">
		                          To
		                          <address id="lastvisit"> </address>
	                        </div>  
	                        
	                        <div class="col-xs-1 col-md-2" >
								<div class="form-group no-margin">
									<a class="btn btn-default" href="#" id="changeclient">
									<span class="" id="changeclient">Change Client</span> </a>
								</div>
							</div> 
							
							<div class="col-sm-2 col-md-2 invoice-col">
	                        	 <label class="">Date: {!! Form::text('invoicedate', '02/24/2017',  ['class'=> 'form-control', 'style' =>'width: 120px;', 'id' => 'invoicedate']) !!}</label>
	                        </div>
	                        
	                        <div class="col-sm-2 col-md-2 invoice-col">
		                          <b>Status:</b> {!!Form::select('status', App\Util::getInvoiceStatus(), null, ['class'=> 'form-control', 'style' => 'width:160px; display: inline important! '])!!}
		                    </div>
		               	 </div>
                      </div>
                      

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                        	
                        	<h3> <br/> 
								Services
                          	</h3>
                          
                          <table class="table table-striped table-bordered bootstrap-datatable datatable" id="mytable">
                            <thead>
                              <tr>
                                <th></th>
                                <th>Qty</th>
                                <th>Stylist</th>
                                <th>Service</th>
                                <th>Cost</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody class="input_fields_wrap">
                            	<tr>
	                                <td width="5px" ></td>
	                                <td><input class="form-control"  style="width: 50px" value="1" id="quantity0" name="quantity[]" type="text" onchange="getsubtotal(0);"></td>
	                                <td>{!!Form::select('stylist[]', $users, null, ['class'=> 'form-control', 'id' => 'userid0'])!!}</td>
	                                <td>{!!Form::select('serviceid[]', $services, null, ['class'=> 'form-control', 'id' => 'serviceid0'])!!}</td>
	                                <td><input class="form-control" style="width: 80px" id="cost0" name="cost[]" type="text" onchange="getsubtotal(0);" ></td>
	                                <td><input class="form-control" style="width: 80px" id="subtotal0" name="subtotal[]" readonly type="text"></td>
	                              </tr>		 
                            </tbody>
                          </table>
                          <button class="add_field_button" id="addfield" onclick="return false;">Add more services</button>
                          
                          
                          <h3> <br/>
								Products
                          	</h3>
                          <table class="table table-striped table-bordered bootstrap-datatable datatable" id="mytable2">
                            <thead>
                              <tr>
                                <th></th>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Cost</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody class="input_fields_wrap2">
                            	<tr>
	                                <td width="5px" ></td>
	                                <td><input class="form-control"  style="width: 50px" value="1" id="quantityinv0" name="quantityinv[]" type="text" onchange="getsubtotalinv(0);"></td>
	                                <td>{!!Form::select('inventoryid[]', $inventories, null, ['class'=> 'form-control', 'id' => 'inventoryid0'])!!}</td>
	                                <td><input class="form-control" style="width: 80px" id="costinv0" name="costinv[]" type="text" onchange="getsubtotalinv(0);" ></td>
	                                <td><input class="form-control" style="width: 80px" id="subtotalinv0" name="subtotal[]" readonly type="text"></td>
	                              </tr>		 
                            </tbody>
                          </table>
                          <button class="add_field_button2" id="addfield2" onclick="return false;">Add more services</button>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      
                      
                      

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Comments:
                            {!! Form::textarea('comment', null,  ['class'=> 'form-control', 'id' => 'comment', 'cols' => '4']) !!}
                          </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Amount Due </p>
                          <div class="table-responsive">
                            <table class="table" >
                              <tbody>
                                <tr >
                                  <th style="width:40%" >Subtotal:</th>
                                  <th style="width:30%" ></th>
                                  <td>{!! Form::text('subtotal', null,  ['class'=> 'form-control', 'id' => 'subtotal']) !!}</td>
                                  
                                </tr>   
                                <tr>
                                  <th>Total:</th>
                                  <th style="width:30%" ></th>
                                  <td>{!! Form::text('total', null,  ['class'=> 'form-control', 'id' => 'total']) !!}</td>
                                </tr>
                                
                                <tr>
                                  <th>Tip:</th>
                                  <th style="width:30%" ></th>
                                  <td>{!! Form::text('tip', 0,  ['class'=> 'form-control']) !!}</td>
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
                          <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit</button>                          
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
        
                          
	{!! Form::close() !!}
	</div> 
 
   </div>
</div>
  <?php $avoidcache = time(); ?>
		
	   
    	<script src="{{ asset ('js/calendar.js?' . $avoidcache)}}"></script>
    	<script src="{{ asset ('js/ajax-functions.js?' . $avoidcache)}}" type="text/javascript"></script> 
    	<script src="{{ asset ('js/salon.js?' . $avoidcache)}}"></script>    
	    <!-- validator -->
	    <script src="{{ asset ('vendors/validator/validator.js')}}"></script>
	    <!--  Masked Input -->
		<script src="{{ asset ('js/jquery.maskedinput.min.js')}}"></script>
		
		<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	
  		<script type="text/javascript">

  			var max_fields      = 15; //maximum input boxes allowed
  			var x = 0; //initlal text box count
  			var xx = 0; //initlal text box count
  		   	function getsubtotal(line)
  		   	{
				var subtotal = $('#quantity'+ line).val() * $('#cost'+ line).val();
				$('#subtotal'+ line).val(subtotal);
				gettotal();
  		   	}

   		    function getsubtotalinv(line)
		   	{
				var subtotalinv = $('#quantityinv'+ line).val() * $('#costinv'+ line).val();
				$('#subtotalinv'+ line).val(subtotalinv);  
				gettotal();
		   	}

  		  	@if($client->a05_id > 0)
  		  		setValueSale("{!! $client->a05_name !!}", "{!! $client->a05_lastname !!}", {!!$client->a05_id !!}, 
  		  			"{!!$client->a05_mobile !!}", "{!!$client->a05_email !!}", "{!!$client->a05_dob !!}");
            @endif	
  		  


  		  	function gettotal()
		   	{
  			   	var total = 0;
  			   	for(i = 0; i <= x; i++)
  			   	{
  			   	  	if($('#subtotal'+ i) != undefined && $('#subtotal'+ i).val() > 0)
					{ 
						total += parseFloat($('#subtotal'+ i).val());
					}
  			   	} 

  			  var totalinv = 0;
  			  	for(i = 0; i <= xx; i++)
			   	{
			   	  	if($('#subtotalinv'+ i) != undefined && $('#subtotalinv'+ i).val() > 0)
					{ 
			   	  		totalinv += parseFloat($('#subtotalinv'+ i).val());
					}
			   	} 
  			  	document.getElementById('total').value = total + totalinv;
		   	}
        
	        jQuery(function($){
	     	  	
	       	 	$( "#invoicedate" ).datepicker({
	       	    	changeMonth: true,
	       	    	changeYear: true
	       	  	});
     		
	       	    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
	       	    var add_button      = $(".add_field_button"); //Add button ID
	       	    
	       	    $(add_button).click(function(e)
				{
		       	    e.preventDefault();
		       		if(x < max_fields)
			     	{ //max input box allowed
	       	            x++; //text box increment
		       	            
		   	        	$(wrapper).append(''+
		 		  	        '<tr ><td width="5px"><a href="#" id="remove_field" class="delete"> X</a></td>'+
		 		  	     	'<td><input style="width: 50px" value="1" class="form-control" id="quantity'+ x +'" name="quantity[]" onchange="getsubtotal('+ x +');" type="text"></td>'+
		 		  	        '<td><select id="userid'+ x +'" name="stylist[]" class="form-control"></select></td>'+			             		
		 		  	        '<td><select id="serviceid'+ x +'" name="serviceid[]" class="form-control"></select></td>'+
		 		  	        '<td><input class="form-control" style="width: 80px" id="cost'+ x +'" name="cost[]" type="text" onchange="getsubtotal('+ x +');"></td>'+	     		  	        
		 		  	        '<td><input class="form-control" style="width: 80px"  id="subtotal'+ x +'" name="subtotal[]" readonly type="text"></td>'+
		 		  	        '</tr>');
		   	        	var $options = $("#userid0 > option").clone();
		   	        	$('#userid'+x).append($options);
		   	    
		   	        	$options = $("#serviceid0 > option").clone();
		       	     	$('#serviceid'+x).append($options);
	       	    	}

	       	    	return false;
	       	    });

		       	 $('#mytable').on('click' , '.delete' , function(){
		       	    $(this).closest('tr').remove();
		       	});

		       	document.getElementById("userid0").value =  "{{ $servicios[0][0] }}";
	       		document.getElementById("serviceid0").value =  "{{ $servicios[0][1] }}";
	       		x++;
	       		@for ($i = 1; $i < count($servicios); $i++)
		       	 	$(".add_field_button").click();
		       		document.getElementById("userid"+ x).value =  "{{ $servicios[$i][0] }}";
		       		document.getElementById("serviceid"+ x).value =  "{{ $servicios[$i][1] }}";
	 			@endfor



	 			var wrapper2         = $(".input_fields_wrap2"); //Fields wrapper
	       	    var add_button2      = $(".add_field_button2"); //Add button ID
	       	    
	       	    $(add_button2).click(function(e)
				{
		       	    e.preventDefault();
		       		if(xx < max_fields)
			     	{ //max input box allowed
	       	            xx++; //text box increment

	       	         $(wrapper2).append(''+ 
	       	        	'<tr> <td width="5px" ><a href="#" id="remove_field2" class="delete"> X</a></td>'+
	                    '<td><input class="form-control"  style="width: 50px" value="1" id="quantityinv'+ xx +'" name="quantityinv[]" type="text" onchange="getsubtotalinv('+ xx +');"></td>'+
	                    '<td><select id="inventoryid'+ xx +'" name="inventoryid[]" class="form-control"></select></td>'+	                    
	                    '<td><input class="form-control" style="width: 80px" id="costinv'+ xx +'" name="costinv[]" type="text" onchange="getsubtotalinv('+ xx +');" ></td>'+
	                    '<td><input class="form-control" style="width: 80px" id="subtotalinv'+ xx +'" name="subtotalinv[]" readonly type="text"></td>'+
	       	      		'</tr>');		
		       	            
		   	        	var $inventory = $("#inventoryid0 > option").clone();
		   	        	$('#inventoryid'+xx).append($inventory);
		   	        	xx++;
	       	    	}

	       	    	return false;
	       	    });

	     	});
        
		</script>

      
      <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="{{ asset ('js/fullcalendar/fullcalendar.min.css')}}" type='text/css' />
    <link rel="stylesheet" href="{{ asset ('js/fullcalendar/fullcalendar.print.css')}}" type='text/css' media='print'  />

    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="{{ asset ('js/fullcalendar/fullcalendar.min.js')}}"></script>
   
    
@endsection