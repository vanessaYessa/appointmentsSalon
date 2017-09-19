
@extends('layouts.master')

@section('content')
       
    <h3 class="blank1">Edit Team: {!! $team->a101_name !!} </h3>
        
        @if($errors->all())
		    <p class="alert alert-danger">
	        	@foreach($errors->all() as $error)
	                {{$error}}<br/>
	            @endforeach
	        </p>
		@endif
       	
       	{!! Form::model($team, ['route' => array('team.update', $team->a101_id), 'method' => 'post'], array( 'class'=>'form-horizontal')) !!}
       	    <!-- Left Column -->   
			<div class="col-sm-6" >
				<div class="form-group">
                    <div class="col-sm-7">
						 {!!Form::select('company', $companies, $team->a101_companyid, ['id' => 'country', 'class'=> 'form-control'])!!}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-7">
                        {!! Form::text('name', $team->a101_name,  ['class'=> 'form-control', 'placeholder' => 'Name *']) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-7">
                        {!! Form::textarea('description',  $team->a101_description, ['class'=> 'form-control', 'placeholder' => 'Description *', 'cols'=> '30', 'rows'=> '4']) !!}
                    </div>
                </div>
                
                
				<div class="form-group">
					<div class="col-sm-7">{!!Form::select('admin', $teams, $team->a101_admin,
						 ['class'=> 'form-control'])!!}</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-7">
						{!!Form::radio('public', 0, ( $team->a101_public == 0 ? 1 : 0), ['class'=> ''])!!} Internal &nbsp;&nbsp;&nbsp;
						{!!Form::radio('public', 1, ( $team->a101_public == 1 ? 1 : 0), ['class'=> ''])!!} External
					</div>
				</div>
				
                <div class="form-group">
                    <div class="col-sm-7">
                    	{!! Form::select('status', ['' => 'Select status', '1' => 'Active','0' => 'Inactive'], $team->a101_status, ['class' => 'form-control']) !!}
                    </div>
                </div>
			</div>
			
			
			<!-- Left Column -->   
			<div class="col-sm-6" >
				<div class="form-group">
                    <div class="col-sm-11">
                    	{!!Form::select('associated[]', $associates, $team->associates, ['id' => 'my-select', 'multiple' => 'multiple'])!!}
                    </div>
                </div>
			</div>
			
			<div class="row">
            	<div class="col-sm-7 col-sm-offset-2">
	                {!! Form::submit('Update',  ['class'=> 'btn-success btn']) !!}
	                {!! Form::button('Back', ['class'=> 'btn-default btn', 'onclick'=> 'javascript:history.back();']) !!}
				</div>
			</div>
            {!! Form::close() !!}


 <style>
	.sol-selected-display-item { display: inline-block;}
</style>
 <link rel="stylesheet" href="{{ asset ('css/sol.css')}}" type='text/css' />
 <script src="{{ asset ('js/sol.js')}}"></script>
 <script type="text/javascript">
 
 	$(document).ready( function() {
	  $('form').addClass( 'form-horizontal' );
	});

 	$('#my-select').searchableOptionList( {
 	    texts: { searchplaceholder: 'Select members' }
 	});
 	 </script>
 
 
@endsection