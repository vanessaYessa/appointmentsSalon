 @include('web.header')
 
 <script src="{{ asset ('vendors/validator/validator.js')}}"></script>
					
	<div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            {!! Form::open(array('action' => 'Auth\AuthController@authenticate', 'class' => 'form-horizontal')) !!}
              <h1>Login Form</h1>
              <div>
                {!! Form::text('username', 'Your username',  [ 'class' => 'form-control required', 'onfocus' => "this.value = '';", 'onblur' => "if (this.value == '') {this.value = 'Your username';}"]) !!}
              </div>
              <div>
                <input name="password" maxlength="15" class="required form-control" type="password" id="pass" placeholder='Password' />
              </div>
              <div>
                {!! Form::submit('LOGIN ', ['class'=> 'btn-green btn']) !!}
                <a style="color: white;font-size: small;" href="{{ url('forgetPassword') }}">Forgot password</a> &nbsp;&nbsp;
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
           {!! Form::close() !!}
          </section>
        </div>
        
        @include('layouts.message')

      </div>
    </div>
    
    
   	
	 
	