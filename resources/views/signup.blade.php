	 @include('web.header')

	<script src="{{ asset ('js/validation/jquery.js')}}"></script>
	<script src="{{ asset ('js/validation/jquery.mockjax.js')}}"></script>
	<script src="{{ asset ('js/validation/jquery.validate.js')}}"></script>
	<script src="{{ asset ('js/jquery.maskedinput.min.js')}}"></script>
	<script src="{{ asset ('js/validation/mktSignup.js')}}"></script>
	<link href="{{ asset ('js/validation/validation.css')}}" rel='stylesheet' type='text/css' />


	<div id="content" >
		<div class="inner" >

			<!-- Left column -->
			<div id="home-intro-text">
				<h1>
					CRichness,  is the new CRM directed to the Lending and Real Estate Professionals in USA.
				</h1>
				<h2>
					
				</h2>
				
			</div>
			<!-- End left column -->

			<!--  Right column -->
			<div class="login_wrapper">				
				<div id="home-search-property" >  
					<div class="content-form">
						{!! Form::open(array('action' => 'WebController@store', 'class' => '', 'id' => 'registration')) !!} 
							
						<div class="error" style="display:none;">
							<span></span><br>
						</div>
							
						<div class="input-group ">
							 {!! Form::text('name', '', ['class'=> 'inputClass required', 'placeholder' => 'Name']) !!}
							 @if ($errors->has('name'))
							 	<div class="error">
							   	 {{ $errors->first('name') }}
							    </div>
							@endif
						</div>

						<div class="input-group">
							 {!! Form::text('lastname', '', [ 'class'=> 'inputClass required', 'placeholder' => 'Lastname']) !!}
							 @if ($errors->has('lastname'))
							 	<div class="error">
							   	 {{ $errors->first('lastname') }}
							    </div>
							@endif
						</div>

						<div class="input-group">
							{!! Form::text('companyname', '', ['class'=> 'required', 'placeholder' => 'Company Name']) !!}
							@if ($errors->has('companyname'))
							 	<div class="error">
							   	 {{ $errors->first('companyname') }}
							    </div>
							@endif
						</div>


						<div class="input-group">
							<input name="password" class="required" maxlength="15" type="password" id="password1" placeholder='Password' />
							@if ($errors->has('password'))
							 	<div class="error">
							   	 {{ $errors->first('password') }}
							    </div>
							@endif
						</div>

						<div class="input-group">
							<input name="password2" class="required" equalTo="#password1" maxlength="15" type="password" id="password2" placeholder='Confirm Password' />
						</div>
						
						<div align="left">
						<br/>	{!! Form::submit('REGISTER', ['class'=> 'btn-blue btn']) !!}
						</div>
					{!! Form::close() !!}
					</div>
				</div>
				
			</div>
			<!-- End rigth column -->
		</div>
	</div>



<style>

	@include('web.footer')
	
	