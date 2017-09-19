
	
	@if(Session::has('flash_message'))
	    <!-- Confirm delete team -->
		<div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabelMsg" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">X</button>
						<h5 class="modal-title  alert " id="myModalLabelMsg">
							{!! session('flash_message') !!} <span class="mif-earth fg-green"></span>
						</h5>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		
		 <script type="text/javascript">
			 $(window).load(function(){
		        $('#myModalMessage').modal('show');
		    });
		 </script>
	@endif
	
	
	  
		   
		
	