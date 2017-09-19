 @if(Session::has('flash_message'))
    <div class="alert alert-success"><em>{!! session('flash_message') !!} </em>
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif


@if(Session::has('error_message'))
    <div class="alert alert-danger"><em>{!! session('error_message') !!} </em>
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif

 <script type="text/javascript">
			 $(window).load(function(){
		        $('#popUpMessage').modal('show');
		    });
		 </script>