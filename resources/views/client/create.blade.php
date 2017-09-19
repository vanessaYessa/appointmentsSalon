 @extends('layouts.master') @section('content')


<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Client:
				@if($client->a05_id == 0) 
					 New client <small></small> 
				@else
					{{ $client->a05_name . ' ' .$client->a05_lastname}} <small></small>
				@endif
				</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			@if($errors->all())
			     <p class="alert alert-danger">
		        	@foreach($errors->all() as $error)
		                {{$error}}<br/>
		            @endforeach
		        </p>
			@endif
		</div>
		
		
		<div class="row">
			<div class="col-md-6 col-xs-12">

				<div class="x_panel">
					<div class="x_title">
						Basic information
					</div>
					<div class="x_content">
						{!! Form::open(array('action' => 'ClientController@store', 'class'
						=> 'form-horizontal', 'novalidate')) !!} {!!
						Form::hidden('clientid', $client->a05_id ) !!}
						<div class="item form-group col-md-6">
							<label for="name">Name *:</label> {!! Form::text('name',
							$client->a05_name, ['data-validate-lengthRange' =>"6", 'class'=>
							'form-control', 'id'=> 'name', 'required', 'style' =>
							'text-transform:capitalize;']) !!}
						</div>
			
						<div class="item form-group col-md-6">
							<label for="lastname">Lastname:</label> {!!
							Form::text('lastname', $client->a05_lastname, ['class'=>
							'form-control', 'id'=> 'lastname', 'style' =>
							'text-transform:capitalize;']) !!}
						</div>
			
			
						<div class="item form-group col-md-6">
							<label for="email">Mobile *:</label> {!! Form::text('mobile',
							$client->a05_mobile, [ 'class'=> 'form-control', 'id'=> 'mobile',
							'required'=> 'required', 'onblur' => 'return verifyPhoneNumber(this.value);']) !!}
							
							  <!-- Small modal -->
	                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	                    <div class="modal-dialog modal-sm">
	                      <div class="modal-content">
	
	                        <div class="modal-header">
	                          <h4 class="modal-title" id="myModalLabel2">Client exist</h4>
	                        </div>
	                        <div class="modal-body" id="clientexistdiv"> </div>
	                        <div class="modal-footer">
	                          <button type="button" class="btn btn-default" data-dismiss="modal">Change number</button>
	                          <button type="button" class="btn btn-primary" onclick="checkclient();">Check client</button>
	                        </div>
	
	                      </div>
	                    </div>
	                  </div>
						</div>
						
						<div class="item form-group col-md-6">
							<label for="clientname">Email:</label> {!! Form::text('email',
							$client->a05_email, ['class'=> 'form-control', 'id'=>
							'clientname' ]) !!}
						</div>
						
						<div class="item form-group col-md-6">
							<label for="email">DOB:</label> {!! Form::text('dob',
							App\Util::getStringFormat3($client->a05_dob), [ 'class'=>
							'form-control', 'id'=> 'dob']) !!}
						</div>
						
						<div class="item form-group col-md-6">
							<label>Gender:</label>
	                   		<br/>
								{!!Form::radio('gender', 1, (($client->a05_gender == '1') ? 1 : 0), ['id' => 'gender'])!!} Female&nbsp;&nbsp;&nbsp;
								{!!Form::radio('gender', 2, (($client->a05_gender == '2') ? 1 : 0), ['id' => 'gender'])!!} Male 
							<br/><br/>
						</div>
						
						<div class=" col-md-12 x_title">
							Follow up information<small></small>
						</div>
						
						<div class="item form-group col-md-3">
							<label for="clientname">Call every:</label> {!! Form::text('callevery',
							$client->a05_calleverynumber, ['class'=> 'form-control', 'id'=>
							'clientname' ]) !!}
						</div>
												
						<div class="item form-group col-md-3">
							<label for="email">Interval:</label>
							{!!Form::select('calleveryperiod', App\Util::getFollowUpInterval(), $client->a05_calleveryperiod, ['id'=> 'calleveryperiod', 'class'=> 'form-control']) !!}							 
						</div>
						
						<div class="item form-group col-md-3">
							<label for="email">Next follow up:</label> {!! Form::text('followupdate',
							App\Util::getStringFormat3($client->a05_followupdate), [ 'class'=>
							'form-control', 'id'=> 'followupdate']) !!}
						</div>
						
						<div class="item form-group col-md-12 ">
							<label for="lastname">Follow Up Comments:</label> {!!
							Form::textarea('followupcomments', $client->a05_followupcomment, ['class'=>
							'form-control', 'rows'=> '2']) !!}
						</div>
						
						<div class="x_title col-md-12">
							Basic information
						</div>
						
						<div class="item form-group col-md-6">
							<label for="statys">Belongs to:</label> 
							{!!Form::select('belongto', $users, $client->a05_belongsto, ['id'=> 'type', 'class'=> 'form-control']) !!}
						</div>
						
						<div class="item form-group col-md-6">
							<label for="statys">Status:</label> <select id="status"
								name="status" class="form-control" required>
								<option value="">Select</option>
								<option value="1" selected="selected">Active</option>
								<option value="2">Inactive</option>
							</select>
						</div>
			
						<div class="item form-group col-md-12">
							<label for="comments">Comments:</label> {!!
							Form::textarea('comments', $client->a05_comments, ['class'=>
							'form-control', 'rows'=> '4']) !!}
						</div>
						
						<div class="col-md-12">{!! Form::submit('Submit', ['class'=>
							'btn-success btn']) !!}</div>
						{!! Form::close() !!}
						<!-- end form for validations -->
					</div>
				</div>
			</div>
			
			
			<div class="col-md-6 col-xs-12">
				@if($client->a05_id != 0)
				<div class="col-md-12 col-xs-12">
					<div class="" role="tabpanel" data-example-id="togglable-tabs">
						
						<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
							<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Follow Up</a></li>
							<li role="presentation" class="">      <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Sales</a></li>
							<!-- <li role="presentation" class=""><a href="#tab_content3" role="tab" id="appointment-tab" data-toggle="tab" aria-expanded="false">Appointment</a></li> -->
						</ul>
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">							
				
								<!--  New Follow up -->
								<div class="col-md-12">
									<div class="col-md-2"><br/>
									<a id="" data-toggle="collapse" href="#collapseExample"
										aria-expanded="false" aria-controls="collapseExample"
										class="btn btn-success"> <i class="fa fa-plus"></i> Add Follow
										Up
									</a>
									</div>
									<div class="clearfix"></div>
									{!! Form::open(array('action' => 'FollowUpController@store', 'class' => 'form-horizontal', 'id' => 'followupform')) !!}
									<div class="collapse well" id="collapseExample">
										<div class="">
											{!!Form::hidden('clientid', $client->a05_id, [ 'id' =>
											'clientid'])!!}
											<div class="modal-header">
												<a class="" role="button" data-toggle="collapse"
													href="#collapseExample" aria-expanded="false"
													aria-controls="collapseExample">
													<button type="button" class="close" data-dismiss="modal"
														aria-hidden="true">X</button>
												</a>
							
												<div class="caption">
													<i class="lnr lnr-cog"></i> Create follow up
												</div>
											</div>
											<div class="modal-body">
												<div class="col-md-4 form-group">
													<label class="control-label ">Contact method *:</label>
													<div class="">{!!Form::select('contactmethod',
														$contactMethod, null, ['class'=> 'form-control', 'id' =>
														'contactMethod', 'onchange' =>
														'setContactMethod(this.value);'])!!}</div>
												</div>
							
												<div class="col-md-3 form-group">
													<label class="control-label ">Date *:</label>
													<div class="">{!! Form::text('startdate', null,
														['id' => 'startdate', 'class'=> 'form-control',
														'placeholder' => 'Contact date *', 'style' => 'width:
														150px;']) !!}</div>
												</div>
							
												<div class="col-md-3 form-group">
													<label class="control-label ">Time*:</label>
													<div class="">{!! Form::text('timefollow', null,
														['id' => 'timefollow', 'class'=> 'form-control',
														'placeholder' => 'Contact time *', 'style' => 'width:
														150px;']) !!}</div>
												</div>
												
												<div class="col-md-12 form-group">
													{!! Form::textarea('comment', null, ['id' => 'comment', 
													'class'=> 'form-control', 'placeholder' => 'comments',  
													'cols'=> '50', 'rows'=> '4']) !!}
												</div>
											</div>				
										</div>
										
										<div class="modal-footer">
											<div id="delmodelcontainer" style="float: right">
												<div id="yes" style="float: left; padding-right: 10px">
													{!!Form::submit('Save', array('class' => 'btn
													btn-primary'))!!}</div>
											</div>
										</div>
									</div>
									{!! Form::close() !!}
								</div><!--\.New Follow up -->
								
								
								<div class="col-md-12">
									@if($followups->count() )
									<ul class="chats">
										@foreach ($followups as $followUp)
										<div class="scroll-view">
											<!-- start recent activity -->
											<ul class="messages">
												<li>
					                                <div class="message_date">
					                                  <h3 class="date text-info">{!! $followUp->day !!}</h3>
					                                  <p class="month">{!! $followUp->month !!}</p>
					                                </div>
					                                <div class="message_wrapper">
					                                  <h4 class="heading"> <i class="fa {!! $followUp->contacttype->a11_icon!!}"></i> {!! $followUp->user->a01_username !!}</h4>
					                                  <blockquote class="message">{!! $followUp->a12_comments!!}</blockquote>					                                  
					                                </div>
					                              </li>
                              
											</ul>
											<!-- end recent activity -->
										</div>
										@endforeach
										<!-- end div scroll -->
									</ul>
									@endif
								</div>
								
							</div>
							
							<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
								<!-- start user projects -->
								<table class="data table table-striped no-margin">
									<thead>
										<tr>
											<th>#</th>
											<th>Project Name</th>
											<th>Client Company</th>
											<th class="hidden-phone">Hours Spent</th>
											<th>Contribution</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>New Company Takeover Review</td>
											<td>Deveint Inc</td>
											<td class="hidden-phone">18</td>
											<td class="vertical-align-mid">asdsa</td>
										</tr>
									</tbody>
								</table>
								<!-- end user projects -->
							</div>
							<!--\. -->	
						</div>
					</div>
				</div>
			<link href="{{ asset ('js/time/jquery.timeentry.css')}}" rel='stylesheet' />
			<script src="{{ asset ('js/time/jquery.plugin.js')}}"></script>
			<script src="{{ asset ('js/time/jquery.timeentry.js')}}"></script>

			<!-- CALENDAR -->
			<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
			<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

				@endif
			</div>
			
		</div>
	</div>
</div>
<!-- /page content -->


<?php $avoidcache = time(); ?>
		
<script src="{{ asset ('js/ajax-functions.js?' . $avoidcache)}}" type="text/javascript"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="{{ asset ('js/salon.js?' . $avoidcache)}}" type="text/javascript"></script>


<script src="{{ asset ('js/time/jquery.plugin.js')}}"></script>
<script src="{{ asset ('js/time/jquery.timeentry.js')}}"></script>
<link href="{{ asset ('js/time/jquery.timeentry.css')}}" rel='stylesheet' />

<script src="{{ asset ('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- validator -->
<script src="{{ asset ('vendors/validator/validator.js')}}"></script>
<!--  Masked Input -->
<script src="{{ asset ('js/jquery.maskedinput.min.js')}}"></script>

<!-- CALENDAR -->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

<script type="text/javascript">
	jQuery(function($){
	    	$("#startdate" ).datepicker({changeMonth: true, changeYear: true, dateFormat: 'mm/dd/yy'});
	    	$("#timefollow").timeEntry({show24Hours: false, showSeconds: false, ampmPrefix: ' ', spinnerImage: ''});
	    	$('#startdate').datepicker('setDate', 'today');
	    	$("#timefollow").timeEntry('setTime', 'now'); 
	    	$("#dob" ).datepicker({changeMonth: true, changeYear: true, dateFormat: 'mm/dd/yy'});
	     	$("#phone").mask("(999) 999-9999");	
	     	$("#mobile").mask("(999) 999-9999");	     	 
	     	$('#status').val( {{$client->a05_status}});
	     	$("#followupdate" ).datepicker({changeMonth: true, changeYear: true, dateFormat: 'mm/dd/yy'});
	 });
     	
 </script>
@endsection
