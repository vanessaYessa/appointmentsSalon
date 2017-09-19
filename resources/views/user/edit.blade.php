
@extends('layouts.master')

@section('content')
    
       
    <h3 class="blank1">Edit User:  {!! $user->a102_name . ' '. $user->a102_lastname !!}</h3>
       
        @if($errors->all())
		    <p class="alert alert-danger">
	        	@foreach($errors->all() as $error)
	                {{$error}}<br/>
	            @endforeach
	        </p>
		@endif
       	
       	{!! Form::model($user, ['route' => array('user.update', $user->a102_id), 'method' => 'post'], array( 'class'=>'form-horizontal')) !!}
       	      
               <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        {!! Form::text('name', $user->a102_name,  ['class'=> 'form-control']) !!}
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Lastname</label>
                    <div class="col-sm-8">
                        {!! Form::text('lastname', $user->a102_lastname, ['class'=> 'form-control']) !!}
                    </div>
                </div>
                    
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Mobile</label>
                    <div class="col-sm-8">
                        {!! Form::text('mobile', $user->a102_mobile,  ['class'=> 'form-control', 'id' => 'mobile']) !!}
                    </div>
                </div>
              
              <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-8">
                        {!! Form::text('phone', $user->a102_phone,  ['class'=> 'form-control', 'id' => 'phone']) !!}
                    </div>
                </div>
                
              
              <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                   {!! Form::text('email', $user->a102_email, ['class'=> 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-8">
						{!! Form::password('password', ['class'=> 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-8">
                        {!! Form::password('password2', ['class'=> 'form-control']) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-8">
                    	{!! Form::select('status', ['1' => 'Active','0' => 'Inactive'], $user->a102_status, ['class' => 'form-control']) !!}
                    </div>
                </div>
                    
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            {!! Form::submit('Update User',  ['class'=> 'btn-success btn']) !!}
                        </div>
                    </div>
                 </div> 
             {!! Form::close() !!}

 
 <script type="text/javascript">

 $(document).ready( function() {
	  $('form').addClass( 'form-horizontal' );
	} );

 jQuery(function($){
   $("#mobile").mask("(999) 999-9999"); //mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
   $("#phone").mask("(999) 999-9999");
});

</script>
@endsection