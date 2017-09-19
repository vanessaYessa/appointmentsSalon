 @include('web.header')


	@if(Session::has('flash_message'))
		<script>
			alert("{!! session('flash_message') !!}");
		</script>
	    <div class="alert alert-success"><em> </em>
	    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    </div>
	@endif
	
	
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
			<br/><br/>
			<div id="home-search">
				<h3>
					<span><a href="" >RECOVER PASSWORD</a></span>
				</h3>
				<div id="home-search-property">
					<div class="content-form">
						{!! Form::open(array('action' => 'Auth\PasswordController@resetPassword', 'class' => 'form-horizontal')) !!} 
						
						<div class="input-group ">
							{!! Form::text('email', 'Your email',  [ 'class' => 'form-control required email', 'onfocus' => "this.value = '';", 'onblur' => "if (this.value == '') {this.value = 'Your email';}"]) !!}
						</div>
						<br/>
						{!! Form::submit('Get Password ', ['class'=> 'btn-green btn']) !!}
					{!! Form::close() !!}
					</div>
					
					 @if($errors->all())
					    <p class="alert alert-danger">
				        	@foreach($errors->all() as $error)
				                {{$error}}<br/>
				            @endforeach
				        </p>
					@endif			
				</div>
				
			</div>
			<!-- End rigth column -->
		</div>
	</div>

	@include('web.footer')