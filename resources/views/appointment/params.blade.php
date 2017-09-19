 @extends('layouts.master') @section('content')




<h3 class="blank1">Calendar Parameters</h3>
@if($errors->all())
<p class="alert alert-danger">
	@foreach($errors->all() as $error) {{$error}}<br /> @endforeach
</p>
@endif 


{!! Form::open(array('action' => 'AppointmentController@saveParams', 'class' => 'form-horizontal')) !!}

<input name="_token" type="hidden" value="{!! csrf_token() !!}" />


<!-- Left Column -->
<div class="col-sm-10">
	<div class="col-md-5">
		<div class="form-group">{!!Form::select('associateId', $associates, null, ['class'=> 'form-control', 'onchange'=> 'getParams(this.value);']) !!}</div>
	</div>
	
	
	<div class="col-md-10 col-md-offset-1">
	</div>
	
	<div class="col-sm-3 col-md-offset-1">
		<BR/>
		<div class="form-group">{!!Form::select('associates[]', $associates2,
			null, ['id' => 'my-select', 'multiple' => 'multiple'])!!}</div>
	</div>
	
	<div class="col-sm-3 col-md-offset-1">
		<BR/><div class="form-group">{!!Form::select('locations[]', $locations,
			null, ['id' => 'my-select2', 'multiple' => 'multiple' ])!!}</div>
	</div>
	
</div>




<div class="row">
	<div class="col-sm-7 col-sm-offset-2"><br/><br/><br/>{!! Form::submit('Save',
		['class'=> 'btn-success btn']) !!} {!! Form::button('Back', ['class'=>
		'btn-default btn', 'onclick'=> 'javascript:history.back();']) !!}</div>
</div>


{!! Form::close() !!}



<link rel="stylesheet" href="{{ asset ('css/sol.css')}}" type='text/css' />
<style>
	/** Show options in one line */
	.sol-selected-display-item { display: inline-block;}
</style>
<script src="{{ asset ('js/sol.js')}}"></script>
<script>
 var associates = $('#my-select').searchableOptionList( {
    texts: { searchplaceholder: 'Select associated members' }
});

 var locations = $('#my-select2').searchableOptionList( {
    texts: { searchplaceholder: 'Select locations' }
});
 </script>

@endsection
