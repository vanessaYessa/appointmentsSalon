 @extends('layouts.master') @section('content')




<h3 class="blank1">New Team</h3>
@if($errors->all())
<p class="alert alert-danger">
	@foreach($errors->all() as $error) {{$error}}<br /> @endforeach
</p>
@endif 


{!! Form::open(array('action' => 'TeamController@store', 'class' => 'form-horizontal')) !!}

<input name="_token" type="hidden" value="{!! csrf_token() !!}" />

<!-- Left Column -->
<div class="col-sm-6">
	<div class="form-group">
		<div class="col-sm-7">{!!Form::select('company', $companies, null,
			['class'=> 'form-control'])!!}</div>
	</div>

	<div class="form-group">
		<div class="col-sm-7">{!! Form::text('name', null, ['class'=>
			'form-control', 'placeholder' => 'Name *']) !!}</div>
	</div>

	<div class="form-group">
		<div class="col-sm-7">{!! Form::textarea('description', null, ['class'=>
			'form-control', 'placeholder' => 'Description *', 'cols'=> '30', 'rows'=> '4']) !!}</div>
	</div>


	<div class="form-group">
		<div class="col-sm-7">{!!Form::select('admin', $team,null,
			 ['class'=> 'form-control', 'placeholder' => 'Team Leader'])!!}</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-7">
			{!!Form::radio('public', 0, true,  ['class'=> ''])!!} Internal &nbsp;&nbsp;&nbsp;
			{!!Form::radio('public', 1, false, ['class'=> ''])!!} External
		</div>
	</div>
</div>


<!-- Left Column -->
<div class="col-sm-6">
	<div class="form-group">
		<div class="col-sm-7">{!!Form::select('associated[]', $associates,
			null, ['id' => 'my-select', 'multiple' => 'multiple'])!!}</div>
	</div>
</div>


<div class="row">
	<div class="col-sm-7 col-sm-offset-2">{!! Form::submit('Create',
		['class'=> 'btn-success btn']) !!} {!! Form::button('Back', ['class'=>
		'btn-default btn', 'onclick'=> 'javascript:history.back();']) !!}</div>
</div>


{!! Form::close() !!}



<link rel="stylesheet" href="{{ asset ('css/sol.css')}}" type='text/css' />
<script src="{{ asset ('js/sol.js')}}"></script>
<script>
$('#my-select').searchableOptionList( {
    texts: { searchplaceholder: 'Select members' }
});
 </script>

@endsection
