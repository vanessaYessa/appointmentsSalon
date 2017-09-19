
@extends('layouts.master')

@section('content')
    
   <h3 class="blank1">Change Password</h3>
   	
   	<link href="{{ asset ('js/validation/validation.css')}}" rel='stylesheet' type='text/css' />
  	<script src="{{ asset ('js/validation/jquery.validate.js')}}"></script>
   	<script src="{{ asset ('js/validation/mktSignup.js')}}"></script>
   	
   	<style>
   		.error {
		  	padding: 0em 0px 0em 0;
		}
   	</style>
	    
        @if($errors->all())
		    <p class="alert alert-danger"> 
	        	@foreach($errors->all() as $error)
	                {{$error}}<br/>
	            @endforeach
	        </p>
		@endif
              
		{!! Form::open(array('action' => 'UserController@changePassword', 'class' => 'form-horizontal', 'id' => 'passwordChange')) !!}
              
              {!! Form::hidden('origin', $origin) !!}
			 <!-- Left Column -->   
			<div class="col-sm-6" >
				<div class="form-group">
                	<div class="col-sm-8">
                    	  {!!Form::password('password',  ['class'=> 'form-control required', 'placeholder' => 'Password', 'id' => 'password'])!!}
                	</div>
				</div>
               
                <div class="form-group">
	            	<div class="col-sm-8">
	                	{!! Form::password('password2',  ['class'=> 'form-control required', 'placeholder' => 'Confirm password', 'equalTo' => '#password' ] ) !!}
	                </div>
				</div>
          	</div>   
          	
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					{!! Form::submit('Save',  ['class'=> 'btn-success btn']) !!}
				</div>
			</div>

{!! Form::close() !!}




@endsection