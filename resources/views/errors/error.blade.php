@extends('layouts.master')

@section('content')

<div id="page-wrapper">
		<div class="graphs">
			<div class="error-main">
				<h3><i class="fa fa-exclamation-triangle"></i> </h3>
			<div class="col-xs-7 error-main-left">
				<span>Sorry!</span>
				<p>{!! session('flash_message') !!}</p>
				<div class="error-btn">
					<a href="#" onclick="javascript:history.back();">Go back?</a>
				</div>
			</div>
		</div>
	</div>
</div>
		
@endsection
