
@extends('layouts.master')

@section('content')
       
    <h3 class="blank1">Edit Prospect:  {!! $prospect->a103_name . ' '. $prospect->a103_lastname !!}</h3>
       
        @if($errors->all())
		    <p class="alert alert-danger">
	        	@foreach($errors->all() as $error)
	                {{$error}}<br/>
	            @endforeach
	        </p>
		@endif
		
		
		<script type="text/javascript">
			getStatusByType( {!!$prospect->status->a012_typeid!!} , {!!$prospect->a103_status!!} )
		</script>

       	{!! Form::model($prospect, ['route' => array('prospect.update', $prospect->a103_id), 'method' => 'post'], array( 'class'=>'form-horizontal')) !!}
			
			 <!-- Left Column -->   
			<div class="col-sm-6" >
				<h4>Prospect Information</h4>
				<div class="form-group">
            	 	<div class="col-sm-9">
                    	  {!!Form::select('company', $companies, null, ['class'=> 'form-control'])!!}
                	</div>
				</div>

                 <div class="form-group">
	               <div class="col-sm-4">
	                	{!! Form::text('owner', $prospect->createdby->a102_name. " ". $prospect->createdby->a102_lastname,  ['class'=> 'form-control', 'disabled' => 'disabled']) !!}	
	                </div>
	                
	                 <div class="col-sm-5">
                    	
                    	@if( Session::get('active_user')['a104_roleid'] < 5  )
                    		{!! Form::select('assistedby', $assistedAssociates, $prospect->a103_assistedby, ['class' => 'form-control']) !!}
                    	@else
                    		{!! Form::hidden('assistedby', $prospect->a103_assistedby) !!}
                    	@endif
                    </div>
				</div>
				
				<div class="form-group">
                    <div class="col-sm-4" >
                        {!! Form::text('name', $prospect->a103_name,  ['class'=> 'form-control', 'placeholder' => 'Name *', 'onchange' => 'capitalize(this);']) !!}
                    </div>
                    
                    <div class="col-sm-5">
	                	{!! Form::text('lastname', $prospect->a103_lastname, ['class'=> 'form-control', 'placeholder' => 'Lastnmae *', 'onchange' => 'capitalize(this);']) !!}
	                </div>
                </div>
				
				
	            <div class="form-group">
                    <div class="col-sm-4" >
                        {!! Form::text('mobile', $prospect->a103_mobile,  ['class'=> 'form-control', 'id' => 'mobile', 'placeholder' => 'Mobile']) !!}
                    </div>
                    
                     <div class="col-sm-5">
	                	{!! Form::text('phone', $prospect->a103_phone,  ['class'=> 'form-control', 'id' => 'phone', 'placeholder' => 'Phone']) !!}
	                </div>
                </div>
                
                <div class="form-group">
	               <div class="col-sm-4">
                  		{!! Form::text('email', $prospect->a103_email, ['class'=> 'form-control', 'placeholder' => 'Email', 'onchange' => 'lowercase(this);']) !!}
                    </div>
                    
                     <div class="col-sm-5">
	                	{!! Form::text('fax', null, ['class'=> 'form-control', 'id' => 'fax', 'placeholder' => 'Fax']) !!}
					</div>
				</div>
                 
              	
				<div class="form-group">
                    <div class="col-sm-4">
                    	{!! Form::select('language', 
                    	App\Util::getLanguages(), $prospect->a103_language, ['class' => 'form-control', 'placeholder' => 'Language']) !!}
                    </div>
                    
                    <div class="col-sm-5">
                    	{!!Form::radio('gender', 'male',( ($prospect->a103_gender == 'male') ? 1 : 0), ['class'=> 'radios'])!!} Male&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;{!!Form::radio('gender', 'female', ( ($prospect->a103_gender == 'female') ? 1 : 0),  ['class'=> 'radios'])!!} Female</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-4">
                    	{!! Form::text('companyname', $prospect->a103_companyname, ['class'=> 'form-control', 'placeholder' => 'Company name', 'onchange' => 'capitalize(this);']) !!}
                    </div>
                    
                    <div class="col-sm-4">
					</div>
                </div>
              
                <div class="form-group">
                    <div class="col-sm-4">
                    	{!! Form::select('statustype', $statusType, $prospect->status->a012_typeid, ['class' => 'form-control', 'id' => 'statustype', 'onchange' => 'getStatusByType(this.value )']) !!}
                    </div>
                    
                    <div class="col-sm-5">
                    	{!! Form::select('status', $status, $prospect->a103_status, ['class' => 'form-control', 'id' => 'status']) !!}
                    </div>
                     
                </div>

                <br/>
                <h4>Address Information</h4>
                <div class="form-group">
                    <div class="col-sm-4">
                    	  {!!Form::select('country', $country, ( ($prospect->state != '') ? $prospect->state->a002_countryid : ''),  ['id' => 'country', 'class'=> 'form-control', 'onchange' => 'getStates(this.value)'])!!}
                	</div>
                	
                	<div class="col-sm-5">
                    	 {!!Form::select('state', $states, $prospect->a103_stateid, ['id' => 'state', 'class'=> 'form-control', 'onchange' => 'getCities(this.value)']) !!}
                	</div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-4">
                    	 {!!Form::select('city', $cities, $prospect->a103_cityid, ['id' => 'city', 'class'=> 'form-control']) !!}
                	</div>
                	
                	 <div class="col-sm-5">
                        {!! Form::text('zipcode', $prospect->a103_zipcode,   ['class'=> 'form-control', 'id' => 'zipcode', 'placeholder' => 'Zipcode']) !!}
                    </div>
                </div>
                
               <div class="form-group">
                    <div class="col-sm-9">
                        {!! Form::text('address', $prospect->a103_address, ['class'=> 'form-control', 'placeholder' => 'Address']) !!}
                    </div>
                </div>
          	</div> 
          
            
            <!-- Right Column -->   
            <div class="col-sm-6" >
            	
                <h4>Call prospect every:</h4>
            	 <div class="form-group">
                    
                    <div class="col-sm-2" >
                    	{!! Form::selectRange('calleverynumber', 0, 30, $prospect->a103_calleverytime,  ['class'=> 'form-control', 'placeholder' => 'Lastname *', 'style' => "width:70px"]) !!}
                    </div>
                    <div class="col-sm-4" >	
                    	{!! Form::select('callevery', App\Util::getCallPeriodicity(), $prospect->a103_calleveryperiod, ['class' => 'form-control', 'placeholder' => 'Select language']) !!}
                   	</div>
                </div>
                
                <h4>Marketing Information</h4>
                <div class="form-group">
                    <div class="col-sm-4">
                    	  {!!Form::select('source', $sources, $prospect->a103_sourceid, [ 'class'=> 'form-control', 'onchange' => 'showCampaigns(this.value);' ])!!}
                	</div>
                	
                	<div class="col-sm-5" id="campaignDiv" style="display: none;">
	                   {!!Form::select('campaign', $campaigns, $prospect->a103_campaignid, ['class'=> 'form-control '])!!}
	                </div>
                </div>
             
                	<div class="form-group">
						<div class="col-sm-8">{!! Form::textarea('sourcecomment', $prospect->a103_sourcecomment, ['class' => 'form-control', 'placeholder' => 'Source Comments']) !!}</div>
					</div>
               
                
                <div class="form-group">
					<div class="col-sm-8">{!!Form::select('services[]', $services,
						$prospect->services, ['id' => 'my-select', 'multiple' => 'multiple'])!!}</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-8">{!! Form::textarea('comments', $prospect->a103_comment, ['class' => 'form-control', 'placeholder' => 'Comments']) !!}</div>
				</div>
            </div> 
           
		
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					{!! Form::submit('Update', ['class'=> 'btn-success btn']) !!}
					{!! Form::button('Back', ['class'=> 'btn-default btn', 'onclick'=> 'javascript:history.back();']) !!}
				</div>
			</div>
			{!! Form::close() !!}
		
 
 <link rel="stylesheet" href="{{ asset ('css/sol.css')}}" type='text/css' />
<script src="{{ asset ('js/sol.js')}}"></script>
<style>
	/** Show options in one line */
	.sol-selected-display-item { display: inline-block;}
</style>
<script type="text/javascript">

	showCampaigns( {{ $prospect->a103_sourceid }} );

	$(document).ready( function() {
		  $('form').addClass( 'form-horizontal' );
	});

	if( "{!! old('state') !!}" != "")
		getStates( "{!! old('country') !!}", "{!! old('state') !!}");

	if( "{!! old('city') !!}" != "")	
		getCities( "{!! old('state') !!}", "{!! old('city') !!}");	
	
	jQuery(function($){
	   $("#mobile").mask("(999) 999-9999");
	   $("#phone").mask("(999) 999-9999");
	   $("#fax").mask("(999) 999-9999");
	});
	
	 $(function() {
		 $('#my-select').searchableOptionList( {
			texts: { searchplaceholder: 'Select service *' }
		 });
	 });
</script>
@endsection
