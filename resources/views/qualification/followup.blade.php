
@extends('layouts.master')

@section('content')




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
	
	
@endsection
	