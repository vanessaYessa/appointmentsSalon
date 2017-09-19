
 @include('web.header')
		
	<script>
		var showBackgrounds = false;

		function dddd()
		{
			document.getElementById("firstTime").style.display ="none";
			document.getElementById("editInfo").style.display ="inline";
		}

		function dddd2()
		{
			document.forms[0].submit(); //editForm
			document.getElementById("firstTime").style.display ="inline";
			document.getElementById("editInfo").style.display ="none";
		}
	</script>	
	
	<div id="content" style="background-color: #c0c0c0;" >
		<div class="inner" >
			<div class=""><br/><br/><br/><br/>
				<h1>You are almost done! Verify your account</h1> 
				
				<div id="firstTime">
					You are intending to register your account as follows:
					<br/><br/>
					
					<div class="form-group">
	                    <label class="col-sm-2 control-label">Name: 
	                         {!! $data->name !!} {!! $data->lastname !!}
	                    </label>
	                </div>
	                
	                <div class="form-group">
	                    <label class="col-sm-2 control-label">Email: 
	                        {!! $data->email !!}
	                    </label>
	                </div>
	                
	                <div class="form-group">
	                    <label class="col-sm-2 control-label">Company Name: 
	                        {!! $data->companyname !!}
	                    </label>
	                </div>
	                
	                <div class="form-group">
	                    <label class="col-sm-2 control-label">Country: 
	                        {!! $state->a002_name !!},  {!! $state->a001_name !!}
	                    </label>
	                </div>
	                
	                <div class="form-group">
	                    <label class="col-sm-2 control-label"> 
	                        <br/><a href="#" >Edit</a> | <a href="#" onclick="verificationCode();">Confirm</a> 
	                    </label>
	                </div>
				</div>
				
				
				<div id="editInfo" style="display: none">
					You edit your information:
					<br/><br/>
					{!! Form::open(array('action' => 'WebController@modifyExpress', 'class' => '', 'id' => 'editForm')) !!}
					
					 {!! Form::hidden('associateId', $memberId) !!}
					 
					<div class="input-group ">
						 <label class="col-sm-2 control-label">Name: </label>
						 {!! Form::text('name', $data->name, ['class'=> 'inputClass', 'placeholder' => 'Name']) !!}
					</div>

					<div class="input-group">
						 <label class="col-sm-2 control-label">Lastname: </label>
						 {!! Form::text('lastname', $data->lastname, [ 'placeholder' => 'Lastname']) !!}
					</div>
					
					
					<div class="input-group">
						 <label class="col-sm-2 control-label">Email: </label>
						{!! Form::text('email', $data->email, [ 'id' => 'email', 'placeholder' => 'Email Address', 'required', 'minlength'=>'3']) !!}
					</div>
	                
	                <div class="input-group">
						<label class="col-sm-2 control-label">Company name: </label>
						{!! Form::text('companyname', $data->companyname, [ 'placeholder' => 'Company Name']) !!}
					</div>
	                
	                <div class="input-group">
						 <label class="col-sm-2 control-label">Country: </label>
						 {!!Form::select('country', $country, null, ['id' =>
						'country', 'onchange' => 'getStates(this.value)', 'class'=> 'form-control'])!!}
					</div>

					<div class="input-group">
						<label class="col-sm-2 control-label">State: </label>
						 {!!Form::select('state', ['' => 'Select'], null, ['id' => 'state', 'class'=> 'form-control'])!!}						
					</div>
	                
	                <div class="form-group">
	                    <label class="col-sm-2 control-label"> 
	                        <br/>{!! Form::submit('Edit',  ['class'=> 'btn-success btn']) !!} 
	                    </label>
	                </div>
	                {!! Form::close() !!}
				</div>
			</div>
	
		</div>
	</div>
		
@include('web.footer')
	