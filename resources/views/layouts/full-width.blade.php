@extends('layout')

@section('body')

	{{-- full-width layout that starts with a container --}}
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				@yield('content')
			</div>
		</div>
	</div>

@stop
