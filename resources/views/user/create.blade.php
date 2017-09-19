 @extends('layouts.master') 
 
 @section('content')


	<!-- Bootstrap Colorpicker -->
    <link href="{{ asset ('vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
      <!-- Bootstrap Colorpicker -->
    	<script src="{{ asset ('vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>


<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>User</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-6 col-xs-12">

				<div class="x_panel">
					<div class="x_title">
						<h2>
							Create new user <small></small>
						</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="row">	

							<!-- start form for validation -->
							{!! Form::open(array('action' => 'UserController@store', 'class'
							=> 'form-horizontal', 'novalidate', "enctype" =>
							"multipart/form-data")) !!} {!! Form::hidden('userid',
							$user->a01_id ) !!}
							<div class="form-group col-md-6 ">
								<label for="name">Name:</label> {!! Form::text('name',
								$user->a01_name, ['data-validate-lengthRange' =>"6", 'class'=>
								'form-control', 'id'=> 'name', 'required']) !!}
	
							</div>
	
	
							<div class="form-group col-md-6 ">
								<label for="lastname">Lastname:</label> {!!
								Form::text('lastname', $user->a01_lastname, ['class'=>
								'form-control', 'id'=> 'lastname', 'required']) !!}
							</div>
	
	
							<div class="form-group col-md-6 ">
								<label for="email">Phone :</label> {!! Form::text('phone',
								$user->a01_phone, [ 'class'=> 'form-control', 'id'=> 'phone',
								'required'=> 'required']) !!}
							</div>
	
							<div class="form-group col-md-6 ">
								<label for="email">Calendar Color :</label> 
								<div class="col-md-9 col-sm-9 col-xs-12">
									<div class="input-group demo1 colorpicker-element">
									{!!Form::text('color', $user->a01_calendarcolor, [ 'class'=> 'demo1
								form-control colorpicker-element', 'id'=> 'color', 'required'=>
								'required']) !!}
								<span class="input-group-addon"><i style="background-color: {{$user->a01_calendarcolor}};"></i></span>
								
									</div>
								</div>
							</div>
							
							<div class="form-group col-md-6">
								<label for="username">Username:</label> 
								{!! Form::text('username', $user->a01_username,  ['class'=> 'form-control', 'id'=> 'username', 'required']) !!}
							</div>
							
							
							<div class="form-group col-md-6">
								<label for="price">Photo:</label>
								{!! Form::file('photo')!!}
							</div>
						</div>
						
						<div class="row">	
							<div class="form-group col-md-6">
								<label for="role">Role*:</label>
		                          <select id="role" name="role" class="form-control" required>
		                            <option value="">Select</option>
		                            <option value="1">Admin</option>
		                            <option value="2">Desk</option>
		                            <option value="3">Stylist</option>
		                          </select>    
	                        </div>
	                        
	                        <div class="form-group col-md-6 ">
								<label for="statys">Show in Calendar:</label><br /> <input
									type="radio" name="showcalendar" checked="checked" required
									value="1"> Yes <input type="radio" name="showcalendar" required
									value="2"> No
							</div>
						</div>
						
						<div class="row">
							
							<div class=" form-group col-md-6">
								<label for="password">Password:</label> 
								{!! Form::password('password',  ['class'=> 'form-control important!', 'id'=> 'password']) !!}
							</div>
							
							
							<div class=" form-group col-md-6">
								<label for="password2">Confirm Password:</label> 
								{!! Form::password('password2',  ['class'=> 'form-control', 'id'=> 'password2']) !!}
							</div>
							
							<div class="form-group col-md-6 ">
								<label for="status">Status:</label> <select id="status"
									name="status" class="form-control" required>
									<option value="">Select</option>
									<option value="1" selected="selected">Active</option>
									<option value="2">Inactive</option>
								</select>
							</div>
						</div>
						
						<div class="row">	
							<div class="form-group col-md-6">
								<br/>{!! Form::submit('Submit', ['class'=> 'btn-success btn']) !!}
							</div>
							 {!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	@include('layouts.scripts')
        
	 <!-- validator -->
	 <script src="{{ asset ('vendors/validator/validator.js')}}"></script>
	    
	  <script>
        
		jQuery(function($){
			$('.demo1').colorpicker();  
	     	$("#phone").mask("(999) 999-9999");
	     	$('#role').val( {{$user->a01_roleid }});
	     	$('#status').val( {{$user->a01_status}});

	     	if( "{{$user->a01_id}}" != "")
	     	{
	     		$("#password").removeAttr("required");
	     		$("#password2").removeAttr("required");
	     	}  
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