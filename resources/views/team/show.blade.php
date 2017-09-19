 @extends('layouts.master') @section('content')


<h3 class="blank1">Team: {!! $team->a101_name !!}</h3>

<!-- Left Column -->
<div class="form-horizontal col-sm-4 content-box-wrapper">

	<div class="form-group">
		<label class="col-sm-3 control-label">Company</label>
		<div class="col-sm-7"><label class="control-label">{!!  $team->a100_name !!}</label></div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">Description </label>
		<div class="col-sm-7">  {!! Form::label($team->a101_description, null, array ('class' => 'control-label'))!!}</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label">Condition</label>
		<div class="col-sm-7">
			 @if ( $team->a101_public == 0 ) 
			 	<label class="control-label">Internal</label> 
			 @else 
			 	<label class="control-label">External </label>
			 @endif  
		</div>
	</div>
				
	<div class="form-group">
		<label class="col-sm-3 control-label">Status</label>
		<div class="col-sm-7">
			 @if ( $team->a101_status == 1 ) <label class="control-label"> Active </label>
			 @elseif ( $team->a101_status == 2 ) <label class="control-label"> Inactive </label>
			 @endif	
		</div>
	</div>
</div>

<!-- Left Column -->
<div class="col-sm-4 content-box-wrapper">
	
	<div class="form-group">
		<label class="col-sm-6 control-label">Team Leader</label>
			<label class="col-sm-5 control-label"> &nbsp;
		@if ( $team->admin != NULL ) 
			{!! $team->admin->a102_name!!}
		@endif	
			</label>
	</div>
	
	<div class="form-group">
		<label class="col-sm-5 control-label">Team Members</label>
			<label class="col-sm-5 control-label">
			@foreach( $team->associates as $associate ) 
				{{$associate->a102_name }} {{ $associate->a102_lastname }} <br />
			@endforeach		
		 </label>
	</div>
	
	
</div>


<div class="row">
	<div class="col-sm-7 col-sm-offset-2">
		<button class="btn-success btn"
			onclick="location.href='{{ url('team/edit', $team->a101_id) }}'">Edit</button>
			
			
		{!! Form::button('Back', ['class'=> 'btn-default btn', 'onclick'=> 'javascript:history.back();']) !!}
	</div>
</div>


@endsection
