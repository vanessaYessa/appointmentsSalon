
@extends('layouts.master')

@section('content')
       
       
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>


    <h3 class="blank1">Prospect: {!! $prospect->a103_name . ' '. $prospect->a103_lastname !!}
    	 <span class="mif-{!!$prospect->a103_gender!!}" data-toggle="tooltip" title="{!!$prospect->a103_gender!!}"></span>
    </h3>
     
  	@if($errors->all())
	    <p class="alert alert-danger">
        	@foreach($errors->all() as $error)
                {{$error}}<br/>
            @endforeach
        </p>
	@endif
      
	<!-- Left Column -->   
		<div class="form-horizontal col-sm-5 content-box-wrapper "  >
				
                <div class="form-group">
	            	<label class="col-sm-3 control-label">Created by</label>
	                <div class="col-sm-9">
	                	 {!!Form::label( $prospect->createdBy->a102_name . ' '. $prospect->createdBy->a102_lastname, null, array ('class' => 'control-label'))!!}
	                	  {!!Form::label( '&nbsp;&nbsp;on &nbsp;&nbsp; ' . App\Util::getStringFormat2($prospect->a103_creationdate) , null, array ('class' => 'control-label'))!!}
	                </div>
	                
	               
				</div>
				
				<div class="form-group">
				<label class="col-sm-3 control-label">Assited by</label>
	                <div class="col-sm-9">
	                	 <b>{!!Form::label( $prospect->assistedby->a102_name . ' '. $prospect->assistedby->a102_lastname, null, array ('class' => 'control-label'))!!}</b>
	                </div>
				</div>
	                
	          <div class="form-group">
                    <label class="col-sm-3 control-label">Phone numbers</label>
                    <div class="col-sm-9" >
                    	@if ( $prospect->a103_mobile != null)
                    		 {!!Form::label( phone_format( $prospect->a103_mobile, "US", 2), null, array ('class' => 'control-label'))!!} <span class="icon-mobile"></span>
                         @endif
                         @if ( $prospect->a103_phone != null)
	                	 	 <br/> {!!Form::label( phone_format( $prospect->a103_phone, "US", 2), null, array ('class' => 'control-label'))!!} <span class="icon-phone"></span>
	                	 @endif
	                	 @if ( $prospect->a103_fax != null)
                    		 <br/>   {!!Form::label( phone_format( $prospect->a103_fax, "US", 2), null, array ('class' => 'control-label'))!!} (FAX)
                         @endif 
                    </div>
                </div>
               
				<div class="form-group">
                    <label class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9" >
                    	@if ( $prospect->a103_address1 != null)
                     		{!!Form::label( $prospect->a103_address1, null, array ('class' => 'control-label'))!!}
                     	@endif 
                     	@if ( $prospect->city != null)
                     		, {!!Form::label( $prospect->city->a003_name, null, array ('class' => 'control-label'))!!}
                     	@endif 
                     	@if ( $prospect->state != null)
	                     	 {!!Form::label( $prospect->state->a002_name, null, array ('class' => 'control-label'))!!}
                     	@endif 
                     	@if ( $prospect->a103_zipcode != null)
                     		, {!!Form::label( $prospect->a103_zipcode, null, array ('class' => 'control-label'))!!}
                     	@endif 
                    </div>
                </div>
                
	             <div class="form-group">
                    <label class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                   	 {!!Form::label( $prospect->a103_email, null, array ('class' => 'control-label'))!!}
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label">Language</label>
                    <div class="col-sm-3">
                    	@if ( $prospect->a103_language > 0 )
                    		<label class="control-label">
                    			<?php echo  App\Util::getLanguages()[$prospect->a103_language]; ?>
                    		</label>
                    	 @endif
                    </div>
                </div>
                
                 <div class="form-group">
                    <label class="col-sm-3 control-label">Company name</label>
                    	<div class="col-sm-9">{!!Form::label( $prospect->a103_companyname, null, array ('class' => 'control-label'))!!}</div>
                </div>
          
				<div class="form-group">
                    <label class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-9">
                    	 {!!Form::label( $prospect->a020_name . ' -  ' . $prospect->status->a012_name, null, array ('class' => 'control-label'))!!}
                    </div>
                </div>
                
                <div class="form-horizontal col-sm-12" >  <br/>  
	        	 	<h4>Marketing Information</h4>
	            	 <div class="form-group">
	                    <label class="col-sm-3 control-label">Source</label>
	                    <div class="col-sm-9">
	                    	  {!!Form::label( $prospect->source->a005_name, null, array('class' => 'control-label'))!!}
	                	</div>
	                </div>
	                
	                <div class="form-group">
						<label class="col-sm-3 control-label">Source Comments</label>
						<div class="col-sm-9 ">
						 {!!Form::label( null, $prospect->a103_sourcecomment, null, array ('class' => 'control-label'))!!}</div>
						 
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Services </label>
						<div class="col-sm-9">
							@foreach( $prospect->services as $associate ) 
								<label class="control-label">{{$associate->a105_name }}  </label> <br />
							@endforeach		
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Other Comments</label>
						<div class="col-sm-9 ">
						 {!!Form::label( null, $prospect->a103_comment, null, array ('class' => 'control-label'))!!}</div>
					</div>
	            </div>	
         </div>  
         
         <!-- Right Column (Follow up)-->   
	<div class="form-horizontal content-box-wrapper col-sm-6">
	
		<a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		 Follow Up  &nbsp;&nbsp;<span class="icon-plus-2"></span> 
		</a>
		&nbsp;&nbsp;
		<span class="icon-alarm-clock" data-toggle="tooltip" title="Calling every {!!$prospect->a103_calleverytime!!} {!!$prospect->a103_calleveryperiod!!}"></span>
		
		<!--  New Follow up -->
		<div>
				
			<div class="collapse" id="collapseExample">
			  <div class="well">
			   		{!! Form::open(array('action' => 'FollowUpController@store', 'class' => 'form-horizontal', 'id' => 'newFollowUp')) !!}
			   			{!!Form::hidden('prospectId', $prospect->a103_id,  [ 'id' => 'prospectId'])!!}
						<div class="modal-header">
							<a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
							  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
							</a>
							
							<h5 class="modal-title" >
								<i class="lnr lnr-cog"></i> Create follow up
							</h5>
						</div>
						<div class="modal-body">
							<div class="form-group">
			                    <div class="col-sm-5">
			                        {!!Form::select('contactMethod', $contactMethod, null, ['class'=> 'form-control', 'id' => 'contactMethod', 'onchange' => 'setContactMethod(this.value);'])!!}  
			                    </div>
			                    
			                    <div class="col-sm-7 social-info">
			                    	{!! Form::text('startdate',  null, ['id' => 'datepicker', 'class'=>
									'form-control2', 'placeholder' => 'Contact date *', 'style' => 'width: 100px;']) !!}&nbsp;&nbsp;&nbsp;
									{!! Form::text('time',  null, ['id' => 'time', 'class'=>
									'form-control2', 'placeholder' => 'Contact time *', 'style' => 'width: 100px;']) !!}
									</div>
			                </div>
			                
			                 <div class="form-group">
			                    <div class="col-sm-12">
			                    	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  									<script>

  								  tinymce.init({
  								    selector: '#comment',
  								     plugins: [
  								      'advlist autolink link image lists charmap hr anchor ',
  								      'searchreplace visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
  								      'save table contextmenu directionality template paste textcolor'
  								    ],
  								    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  forecolor backcolor emoticons'
  								  });</script>
  									
  									{!! Form::text('emailTitle', null,  ['id' => 'emailTitle', 'placeholder' => 'Email Title', 'style' => 'display:none', 'class'=> 'form-control']) !!}
  									
			                        {!! Form::textarea('comment', null,  ['id' => 'comment', 'placeholder' => 'Email content', 'cols'=> '50', 'rows'=> '4']) !!}
			                    </div>
			                    
			               	 </div>

						</div>
						<div class="modal-footer">
							<div id="delmodelcontainer" style="float: right">
								<div id="yes" style="float: left; padding-right: 10px">
								{!!Form::submit('Save', array('class' => 'btn btn-primary'))!!} 
								</div>
							</div>
						</div>
					{!! Form::close() !!}
			  </div>
			</div>
		</div>
		<!--\.New Follow up -->

		
		
		@if($followUps->count() )
		<!-- Follow Ups List -->
		<div class="panel-group scrollbar" style="height:auto; max-height: 800px" id="accordion" role="tablist" aria-multiselectable="true">
			 
			  @foreach ($followUps as $followUp)
			   <!-- Panel scroll -->
			   <div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFive">
					  <i class="icon_14"><span class="{!! $followUp->a011_icon !!}"></span></i>
					  <h4 class="panel-title asd">
						<a class="pa_italic collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#followUp{{$followUp->a112_id}}" aria-expanded="false" aria-controls="collapseFive">
						 	<label>{!! str_limit( $followUp->a112_comments, 45) !!}<label>
						</a>
					  </h4>
					  <a style="text-align: right;" href="#!" class="secondary-content">
					  	<span class="blue-text ultra-small">
					  		{!! App\Util::getStringFormat2($followUp->a112_date) !!}
						  	<br/> 
						  	{!! App\Util::getTimeFormat($followUp->a112_date) !!}
					  	</span>
					  </a>
					</div>
					
					<!-- Follow up detail -->
					<div id="followUp{{$followUp->a112_id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" aria-expanded="false">
					  @if($followUp->a112_contactmethodid == 6 )
					  	<div class="panel-body panel_text" >
					  		{!! $followUp->a112_comments !!}
					  	</div>
					  @else
					  	 <div class="panel-body panel_text" class="editable" id="followUp-{{$followUp->a112_id}}" contenteditable="true">
							{!! $followUp->a112_comments !!}
						  </div>
						  <a href="#" onclick="document.getElementById('followUp-{{$followUp->a112_id}}').focus(); document.getElementById('saveLink{{$followUp->a112_id}}').style.display='';">
								Edit
						  </a>
						  <a href="#" class="met-top" id="saveLink{{$followUp->a112_id}}" style="display: none" >
								Save
						  </a>
					  @endif
					   
					  
					  <div class="media-body2" align="center">
					  	<table style="width: 100%">
					  		<tr>
					  			<td align="left">Creation User: {!! $followUp->a102_name !!} {!! $followUp->a102_lastname !!}</td>
					  			<td width="50%" align="right">Creation Date: {!! $followUp->a112_creationdate !!}</td>
					  		</tr>
					  	</table>
					  </div>
					</div>
					<!-- /. Follow up detail -->
				  </div>
				 @endforeach
				 <br/>
			  <!-- /. Panel scroll -->
		</div>
		<!-- /. Follow Ups List -->
		
		@include('layouts.popup')
		
		@endif
		
	</div> 

	<div class="row">
		<div class="col-sm-8 col-sm-offset-2"><br/>
			<button class="btn-success btn" onclick="location.href='{{ url('prospect/edit', $prospect->a103_id) }}'">Edit</button>
			&nbsp;&nbsp;&nbsp;
			<button class="btn-success btn" onclick="location.href='{{ url('transaction/create', $prospect->a103_id) }}'">Ready for Originate</button>
							&nbsp;&nbsp;&nbsp;
			{!! Form::button('Back', ['class'=> 'btn-default btn', 'onclick'=> 'javascript:history.back();']) !!}
		</div>
	</div>
	
 <!-- CALENDAR -->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

<script src="{{ asset ('js/time/jquery.plugin.js')}}"></script>
<script src="{{ asset ('js/time/jquery.timeentry.js')}}"></script>
<link href="{{ asset ('js/time/jquery.timeentry.css')}}" rel='stylesheet' />

<script>
	$("#datepicker" ).datepicker({changeMonth: true, changeYear: true, dateFormat: 'mm-dd-yy'});
	$("#time").timeEntry({show24Hours: false, showSeconds: false, ampmPrefix: ' ', spinnerImage: ''});
	$('#datepicker').datepicker('setDate', 'today');
	$("#time").timeEntry('setTime', 'now'); 

	$("div[contenteditable=true]").blur(function(){
        var field_userid = $(this).attr("id") ;
        var field2 = field_userid.split("-");		       
        var idUpdate =field2[1]; 
        var fieldUpdate =field2[0];
        var value2 = $(this).text();
        editFollowUpOnline(idUpdate, value2);		        
    });

    function setContactMethod(contactId)
    {
		if(contactId == 6)
		{
			$("#emailTitle").css({"display": ""}); 	 
		}
		else
		{
			$("#emailTitle").css({"display": "none"}); 	
		}
    }	

    
 </script>
 

@endsection