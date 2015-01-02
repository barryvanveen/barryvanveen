@extends('layout')

@section('body')

	{{-- full-width layout that starts with a container --}}
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-push-2 col-lg-6 col-lg-push-3">
				@yield('content')
			</div>
		</div>
	</div>

@stop
