 @extends('layouts.master') 
 
 @section('content')


<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Service</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Create new service <small></small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<!-- start form for validation -->						 
						 {!! Form::open(array('action' => 'ServiceController@store', 'class' => 'form-horizontal', 'novalidate', "enctype" => "multipart/form-data")) !!} 
							{!! Form::hidden('serviceid',  $service->a02_id ) !!}
							<div class="item form-group ">	
							<label for="name">Name:</label> 
							 {!! Form::text('name', $service->a02_name,  ['data-validate-lengthRange' =>"6", 'class'=> 'form-control', 'id'=> 'name', 'required']) !!}
							  
							 </div>
							 
							 
							 <div class="item form-group ">
								 <label for="lastname">Description:</label> 
								 {!! Form::textarea('description', $service->a02_description,  ['class'=> 'form-control', 'id'=> 'lastname', 'required']) !!}
							</div>
							
							 <div class="item form-group ">
								 <label for="lastname">Duration:</label> 
								 {!! Form::text('duration', $service->a02_duration,  ['class'=> 'form-control', 'id'=> 'duration']) !!}
								 <select id="scale" name="scale" class="form-control" required>
			                            <option value="">Select</option>
			                            <option value="1" selected="selected">minutes</option>
			                            <option value="2">hour</option>
			                       	</select>
							</div>
							
							<div class="item form-group">
								 <label for="price">Photo:</label> 							 
								 <div class="input-group input-group-sm">
									{!! Form::file('photo') !!}
								 </div>
							</div>
									
							<div class="item form-group">
								 <label for="price">Price:</label> 							 
								 <div class="input-group input-group-sm">
									<label class="input-group-addon" for="dataScaleX">$</label>
									 <input type="number" class="form-control" name="price" value="{!!$service->a02_price!!}"  pattern= 'numeric'>
								 </div>
							</div>
							
							<div class="item form-group">
								 <label for="price">Follow Up :</label> 							 
								 <div class="input-group input-group-sm">
									 <input type="number" class="form-control" name="followup" value="{!!$service->a02_remindevery!!}"  pattern= 'numeric'>
									 <label class="input-group-addon" for="dataScaleX"> days</label>
									
								 </div>
							</div>
							
							
	                        <div class="item form-group ">
								<label for="statys">Status:</label> 
									<select id="status" name="status" class="form-control" required>
			                            <option value="">Select</option>
			                            <option value="1" selected="selected">Active</option>
			                            <option value="2">Inactive</option>
			                       	</select>
							</div>                      
                          <br />
                          
                          {!! Form::submit('Submit',  ['class'=> 'btn-success btn']) !!}
                          
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
	     	  $('#status').val( {{$service->a02_status}});	     	  
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