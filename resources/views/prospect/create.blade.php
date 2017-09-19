
@extends('layouts.master')

@section('content')
    
   <div class="x_panel">
		<div class="x_title">
    		<h3 class="blank1">New Prospect</h3>
    	</div>
    	
    	<div class="x_content">	
			<div class="col-sm-12">
					@if($errors->all())
		    <p class="alert alert-danger"> 
	        	@foreach($errors->all() as $error)
	                {{$error}}<br/>
	            @endforeach
	        </p>
	        
 		<script type="text/javascript">
 				getStates( "{!! old('country') !!}", "{!! old('state') !!}");
 				getCities("{!! old('state') !!}", "{!! old('city') !!}");
		</script> 
		@endif
		
		<p class="alert alert-danger" id="error1" style="display: none"> </p>
              
		{!! Form::open(array('action' => 'ProspectController@store', 'class' => 'form-horizontal')) !!}
     		 <!-- Left Column -->   
			<div class="col-sm-6" >
				<h4>Prospect Information</h4>
				
                <div class="form-group">
                    <div class="col-sm-4" >
                        {!! Form::text('name', null,  ['class'=> 'form-control', 'placeholder' => 'Name *']) !!}
                    </div>
                    
                    <div class="col-sm-5">
	                	{!! Form::text('lastname', null, ['class'=> 'form-control', 'placeholder' => 'Lastname *']) !!}
	                </div>
                </div>
                
                <label>Gender *:</label>
				<p>
					M: <input type="radio" class="flat" name="gender" id="genderM"
						value="M" checked="" required /> F: <input type="radio"
						class="flat" name="gender" id="genderF" value="F" />
				</p>
                    
	            <div class="form-group">
                    <div class="col-sm-4" >
                        {!! Form::text('mobile', null,  ['class'=> 'form-control', 'id' => 'mobile', 'placeholder' => 'Mobile', 'onblur' => 'checkProspectExist(this.value, "")']) !!}
                    </div>
                    
                    <div class="col-sm-5">
	                	{!! Form::text('phone', null,  ['class'=> 'form-control', 'id' => 'phone', 'placeholder' => 'Phone']) !!}
	                </div>
                </div>
              
                <div class="form-group">
                    <div class="col-sm-4">
                   {!! Form::text('email', null, ['class'=> 'form-control', 'placeholder' => 'Email', 'onblur' => 'checkProspectExist("", this.value)']) !!}
                    </div>
                    
                    <div class="col-sm-5">
	                	{!! Form::text('fax', null, ['class'=> 'form-control', 'id' => 'fax', 'placeholder' => 'Fax']) !!}
					</div>
                </div>
               
				<div class="form-group">
                    <div class="col-sm-4">
                    	{!! Form::select('language', 
                    	App\Util::getLanguages(), null, ['class' => 'form-control', 'placeholder' => 'Select language']) !!}
                    </div>
                    
                    <div class="col-sm-4">
						<label class="control-label">	 
						{!!Form::radio('gender', 'male', true, ['class'=> ''])!!} Male &nbsp;&nbsp;&nbsp;
						{!!Form::radio('gender', 'female', false,  ['class'=> ''])!!} Female</label>
					</div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-4">
                    	{!! Form::text('companyname', null, ['class'=> 'form-control', 'placeholder' => 'Company name']) !!}
                    </div>
                    
                    <div class="col-sm-4">
					</div>
                </div>
              
				 <div class="form-group">
                    <div class="col-sm-4">
                    	{!! Form::select('statustype', $statusType, null, ['class' => 'form-control', 'id' => 'statustype',
                    	 'onchange' => 'getStatusByType(this.value)']) !!}
                    </div>
                    <script type="text/javascript">
                    	document.getElementById("statustype").value = 2;
	                    getStatusByType(2, 9);
                    </script>
                    
                    <div class="col-sm-5">
                    	{!! Form::select('status', ['Select status *'], null, ['class' => 'form-control', 'id' => 'status']) !!}
                    </div>
                </div>
				
				<br/>
				<h4>Address Information</h4>
				
                <div class="form-group">
                    <div class="col-sm-4">
                    	  {!!Form::select('country', $country, null, ['id' =>
							'country', 'class'=> 'form-control', 'onchange' =>
							'getStates(this.value)'])!!}
                	</div>
                	<script>
                	$("#country").val("1");
                	</script>
                	
                	 <div class="col-sm-5">
                    	 {!!Form::select('state', $states, null, ['id' => 'state', 'class'=> 'form-control', 'onchange' => 'getCities(this.value)']) !!}
                	</div>
                </div>
                
                <div class="form-group">
                	<div class="col-sm-4">
                    	  {!!Form::select('city', ["Select city"], null, ['id' => 'city', 'class'=> 'form-control']) !!}
                	</div>
                	
                	<div class="col-sm-5">
                        {!! Form::text('zipcode', null,  ['class'=> 'form-control', 'id' => 'zipcode', 'placeholder' => 'Zipcode']) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-9">
                        {!! Form::text('address', null,  ['class'=> 'form-control', 'placeholder' => 'Address']) !!}
                    </div>
                    
                    
                </div>
               
          	</div>   
     
            <!-- Right Column -->   
            <div class="col-sm-6" >
            	<h4>Call prospect every:</h4>
            	 <div class="form-group">
                    
                    <div class="col-sm-2" >
                    	{!! Form::selectRange('calleverynumber', 0, 30, null,  ['class'=> 'form-control', 'placeholder' => 'Lastname *', 'style' => "width:70px"]) !!}
                    </div>
                    <div class="col-sm-4" >	
                    	{!! Form::select('callevery', App\Util::getCallPeriodicity(), null, ['class' => 'form-control', 'placeholder' => 'Select language']) !!}
                   	</div>
                </div>
                
                
                <h4>Marketing Information</h4>
            	 <div class="form-group">
                    <div class="col-sm-4">
                    	  {!!Form::select('source', $sources, null, [ 'class'=> 'form-control', 'onchange' => 'showCampaigns(this.value);', 'placeholder' => 'Select Company'])!!}
                	</div>
                	
                	<div  id="campaignDiv" style="display: none;">
	                    <div class="col-sm-6">
					        {!!Form::select('campaign', $campaigns, null, ['class'=> 'form-control '])!!}
	                    </div>
	                </div>
                </div>
                
                <div class="form-group">
					<div class="col-sm-9">{!! Form::textarea('sourcecomment', null, ['class' => 'form-control', 'placeholder' => 'Source Comments', 'rows' => 5, 'cols' => 40]) !!}</div>
				</div>
                
                <div class="form-group">
					<div class="col-sm-9">{!!Form::select('services[]', $services,
						null, ['id' => 'my-select', 'multiple' => 'multiple'])!!}</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-9">{!! Form::textarea('comments', null, ['class' => 'form-control', 'placeholder' => 'Comments', 'rows' => 5, 'cols' => 40]) !!}</div>
				</div>
                
            </div> 
		
			<div class="col-sm-8 col-sm-offset-2">
				{!! Form::submit('Create',  ['class'=> 'btn-success btn']) !!}
				{!! Form::button('Back', ['class'=> 'btn-default btn', 'onclick'=> 'javascript:history.back();']) !!}
			</div>
		{!! Form::close() !!}
			</div>
		</div>	
	</div>

<link rel="stylesheet" href="{{ asset ('css/sol.css')}}" type='text/css' />

<style>
	.sol-selected-display-item { display: inline-block;}
</style>


<script src="{{ asset ('js/sol.js')}}"></script>
<script type="text/javascript">

 jQuery(function($){
   	$("#mobile").mask("(999) 999-9999");
   	$("#phone").mask("(999) 999-9999");
   	$("#fax").mask("(999) 999-9999");
  });
 
 $('#my-select').searchableOptionList( {
     texts: { searchplaceholder: 'Select service *' }
 });

	
//$("#state").val("34");

 
</script>
@endsection