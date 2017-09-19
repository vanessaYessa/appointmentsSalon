 @extends('layouts.master') 
 
 @section('content')


<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Inventory</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Create new inventory <small></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<!-- start form for validation -->						 
						 {!! Form::open(array('action' => 'InventoryController@store', 'class' => 'form-horizontal', 'novalidate')) !!} 
							{!! Form::hidden('inventoryid',  $inventory->a15_id ) !!}
							<div class="form-group ">	
							<label for="name">Name:</label> 
							 {!! Form::text('name', $inventory->a15_name,  ['class'=> 'form-control', 'id'=> 'name', 'required']) !!}
							 </div>
							 
							 
							 <div class="form-group ">
								 <label for="lastname">Description:</label> 
								 {!! Form::textarea('description', $inventory->a15_description,  ['class'=> 'form-control', 'id'=> 'description', 'rows' => 3]) !!}
							</div>
							
							<div class="form-group col-md-6">	
							<label for="name">Brand:</label> 
							 {!! Form::text('brand', $inventory->a15_brand,  ['class'=> 'form-control', 'id'=> 'brand']) !!}
							 </div>
							
							 <div class="form-group col-md-6">
								 <label for="type">Type:</label>
							 	<select id="type" name="type" class="form-control" required>
		                            <option value="">Select</option>
		                            <option value="1">Countable</option>
		                            <option value="2">Uncontable</option>
		                       	</select>
							</div>
							
									
							<div class="form-group col-md-6">
								 <label for="price">Quantity:</label> 							 
								 <div class="input-group input-group-sm">
									 <input type="number" class="form-control" name="quantity" required value="{!!$inventory->a15_quantity!!}"  pattern= 'numeric'>
								 </div>
							</div>
							
							<div class="form-group col-md-6">
								 <label for="price">Price:</label> 							 
								 <div class="input-group input-group-sm">
									<label class="input-group-addon" for="dataScaleX">$</label>
									 <input type="number" class="form-control" name="price" required value="{!!$inventory->a15_price!!}"  pattern= 'double'>
								 </div>
							</div>
							
	                        <div class="form-group ">
								<label for="statys">Status:</label> 
									<select id="status" name="status" class="form-control" required>
			                            <option value="">Select</option>
			                            <option value="1" >Active</option>
			                            <option value="2">Inactive</option>
			                       	</select>
							</div>                      
                          <br />
                          
                          {!! Form::submit('Submit',  ['class'=> 'btn-success btn']) !!}
                          {!! Form::button('Back', ['class'=>
							'btn-default btn', 'onclick'=> 'javascript:history.back();']) !!}
                          
                        </form>
                    <!-- end form for validations -->	
                  	</div>
                </div>


             </div>

         </div>

	</div>
</div><!-- /page content -->
      
      	@include('layouts.scripts')
        
	    <!-- validator -->
	    <script src="{{ asset ('vendors/validator/validator.js')}}"></script>
  
        <script>
        
	        jQuery(function($){
	     	  $('#status').val( {{$inventory->a15_status}});	     	  
	     	});
     	
          // initialize the validator function
          validator.message.date = 'not a real date';
          // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
          $('form')
            
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);
          $('.multi.required').on('keyup blur', 'input', function() {
            validator.checkField.apply($(this).siblings().last()[0]);
          });
          $('form').submit(function(e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
              submit = false;
            }
            if (submit)
              this.submit();
            return false;
          });
        </script>

@endsection