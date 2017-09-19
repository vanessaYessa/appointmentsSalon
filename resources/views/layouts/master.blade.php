<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Leonardo Maciel Salon</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap -->
    <link href="{{ asset ('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset ('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- iCheck -->
	<link href="{{ asset ('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
	<link href="{{ asset ('css/custom.min.css')}}" rel="stylesheet">
	
	<script src="{{ asset ('js/jquery-1.10.2.min.js')}}"></script>
  </head>

  <body class="nav-sm">

	<script type="text/javascript">
		var localhost = "http://localhost/leonardo/";
	</script> 

	 <div class="container body">
      <div class="main_container">
     
     	@include('layouts.menu')
     	
        <!-- page content -->
        @include('layouts.popup')
        @yield('content')
        <!-- footer content -->
        
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
	
	
    
  </body>
</html>