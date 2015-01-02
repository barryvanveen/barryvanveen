@extends('layout')

@section('body')

	{{-- two-columns of equal width --}}
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-6">
				@yield('left-column')
			</div>
			<div class="col-xs-12 col-md-6">
				@yield('right-column')
			</div>
		</div>
	</div>

@stop
