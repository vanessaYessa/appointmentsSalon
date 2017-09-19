		
	<script type="text/javascript">
		if(showBackgrounds)
		{
			var images = ['cover1.jpg', 'cover2.jpg']; //
		 	$('#content').css({'background-image': 'url(images/' + images[Math.floor(Math.random() * images.length)] + ')'});	
		}
	</script>
	
	
	<!-- BEGIN JIVOSITE CODE {literal} -->
	<script type='text/javascript'>
	(function(){ var widget_id = 'DYyDxlo1RA';
	var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
	<!-- {/literal} END JIVOSITE CODE -->
	
	<div id="footer">
			<div class="inner">
				
				<div class="image-footer">
					<img src="{{ url('/images/equal_housing_opportunity.png') }}" width="70px" height="70px" />
				</div>
				
				<p>
					<a href="{{ url('/') }}" target="_blank" >Home</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
					<a href="{{ url('/') }}" target="_blank" >About</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
					<a href="http://www.colamerica.com" target="_blank">Blog</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
					<a href="{{ url('/') }}" target="_blank">Legal</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
					<a href="{{ url('/') }}" target="_blank">Privacy</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				</p>
			</div>
		</div>
	</div>
</body>
</html>




