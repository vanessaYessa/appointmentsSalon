 @extends('layouts.master') 
 
 @section('content')
 
<h3 class="blank1">Pipeline</h3>

	<div class="col-sm-12">		
		{!! Form::open(array('action' => 'PipelineController@index', 'class' => 'form-horizontal')) !!}
		
		<table id="" class="table table-striped table-bordered display"  >
            <tr>
            	<th width="32%">
            		{!! Form::text('startdate', $filter[0], ['class' => 'form-control2',  'id' => 'datepicker', 'placeholder' => 'Origination Date >=', 'style' => 'width:130px']) !!}
					&nbsp;
					{!! Form::text('enddate', $filter[1], ['class' => 'form-control2','id' => 'dateendpicker', 'placeholder' => 'Origination Date <=', 'style' => 'width:130px']) !!}
				</th>
				
				<th >
					 {!! Form::select('associate', $associates, $filter[2], ['class'=> 'form-control']) !!}
				</th>
				<th>
					{!! Form::select('appliedFor', $appliedFor, $filter[4], ['class'=> 'form-control']) !!}
				</th>
			 </tr>	
			 
			 <tr>	
				<th >
					{!! Form::select('loanPurpose', $loanPurpose, $filter[5], ['class'=> 'form-control']) !!}
				</th>
				<th >
				{!! Form::select('status', $statusA, $filter[3], ['class'=> 'form-control']) !!}
				</th>
				<th >
					{!! Form::submit('Filter', ['class'=> 'btn btn-primary']) !!} 
				{!! Form::reset('Reset', ['class'=> 'btn-btn-info btn']) !!}
				</th>
            </tr>      
          </table>   
            
       <div style="margin-left: 20em">
        <table id="" class="table" style="width: 60%;"  >    
            <tr>	
				<th >
					<div class="alert alert-success" id="totalTran"></div>	
				</th>
				<th >
					<div class="alert alert-success" id="totalAmountTran"></div>	
				</th>
				
				<th >
						
				</th>
            </tr>
         </table></div>
	{!! Form::close() !!} 
	</div>
	
	<div class="row" id="content">
		
	</div>
	
	<style>
		.scrollbar2 {
		    height: 380px;
		    background: #fff;
		    overflow-y: scroll;
		}
	</style>
	<script type="text/javascript">
		initValue();
		@foreach( $tranStatus as $id=> $name )
			getTransactionsById( {!! $id!!}, '{!! $name!!}' );
		@endforeach
	</script>
	
	
	
	<!-- Express Prospect Modal -->
	<div class="modal fade" id="followup" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				{!! Form::open(array('action' => 'TransactionFollowUpController@store', 'class' => 'form-horizontal')) !!}
				{!!Form::hidden('transactionId', null,  [ 'id' => 'transactionId'])!!}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">X</button>
					<h5 class="modal-title" >
						<i class="icon-user"></i> Transaction Follow Up
					</h5>
				</div>
				<div class="modal-body">
					<div class="form-group">
	                    <div class="col-sm-5">
	                        {!!Form::select('contactMethod', $contactMethod, null, ['class'=> 'form-control', 'id' => 'contactMethod', 'onchange' => 'setContactMethod(this.value);'])!!}  
	                    </div>
	                  
	                    <div class="col-sm-7 social-info">
                    	{!! Form::text('date',  null, ['id' => 'datepicker2', 'class'=>
						'form-control2', 'placeholder' => 'Contact date *', 'style' => 'width: 120px;']) !!}&nbsp;&nbsp;&nbsp;
						{!! Form::text('time',  null, ['id' => 'time', 'class'=>
						'form-control2', 'placeholder' => 'Contact time *', 'style' => 'width: 120px;']) !!}
						</div>
	                </div>
	                
	                 <div class="form-group">
	                    <div class="col-sm-12">
	                        {!! Form::textarea('comment', null,  ['id' => 'comment', 'placeholder' => 'Comments', 'cols'=> '60', 'rows'=> '4']) !!}
	                    </div>	                    
	                </div>
	                
	                 <div class="form-group">
						
						<div class="col-sm-12"  >
		                  {!! Form::select('status', $statusA, null, ['id' => 'status', 'class' => 'form-control', 'style' => "display: inline;width:auto"]) !!}
		                </div>
		                
					</div>
					
					@if($errors->all())
					    <p class="alert alert-danger">
				        	@foreach($errors->all() as $error)
				                {{$error}}<br/>
				            @endforeach
				        </p>
					@endif
					
					<div class="modal-footer">
						<div id="delmodelcontainer" style="float: right">
							<div id="yes" style="float: left; padding-right: 10px">
							{!!Form::submit('Save', array('class' => 'btn btn-primary'))!!} 
							</div>
							<div id="no" style="float: left;">
								<button type="button" class="btn btn-defualt" data-dismiss="modal">Cancel</button>
							</div>
						</div>
					</div>
			{!! Form::close() !!}
	                
	                <hr/>
	                
	                <div id="followuptable">
	                
	                </div>
	                
	           
				</div>
				
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.Express Prospect Modal -->
	
	 <!-- CALENDAR -->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

<script src="{{ asset ('js/time/jquery.plugin.js')}}"></script>
<script src="{{ asset ('js/time/jquery.timeentry.js')}}"></script>
<link href="{{ asset ('js/time/jquery.timeentry.css')}}" rel='stylesheet' />

<script>
	$("#datepicker2" ).datepicker({changeMonth: true, changeYear: true, dateFormat: 'mm-dd-yy'});
	$("#datepicker" ).datepicker({changeMonth: true, changeYear: true, dateFormat: 'mm-dd-yy'});
	$('#followup').modal();
	$("#dateendpicker" ).datepicker({changeMonth: true, changeYear: true, dateFormat: 'mm-dd-yy'});
	$("#time").timeEntry({show24Hours: false, showSeconds: false, ampmPrefix: ' ', spinnerImage: ''});
	$('#datepicker2').datepicker('setDate', 'today');
	$("#time").timeEntry('setTime', 'now'); 
</script>


@include('layouts.table')
@endsection
