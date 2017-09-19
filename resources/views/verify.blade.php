
 @include('web.header')
		
	<script>
		var showBackgrounds = false;
	</script>	
	
	<div id="content" style="background-color: #c0c0c0;" >
		<div class="inner" >
			<div class=""><br/><br/><br/><br/>
				<h1>Verify your account</h1> 
				
				<div>
				Please enter the verification code we sent to your email. <br/>
				If you did not receive a code, please verify your spam folder or 
				<a href="">retry here</a> 
				<br/><br/><br/>
				</div>
				
				<div>
					{!! Form::open(array('action' => 'WebController@verificate', 'class' => 'form-horizontal')) !!}
		
					<div class="col-sm-3 ">
						<label class="col-sm-10 control-label">Verification code:</label>
						{!! Form::text('verify_number', null,  [ 'id' => 'mobile']) !!}
						
						@if($errors->all())
					    <p class="alert alert-danger-verification">
				        	@foreach($errors->all() as $error)
				                {{$error}}<br/>
				            @endforeach
				        </p>
					@endif
					</div>
					
					<br/><br/>{!! Form::submit('Send',  ['class'=> 'btn-blue btn']) !!}
					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
		
@include('web.footer')
	