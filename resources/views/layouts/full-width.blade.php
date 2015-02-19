@extends('layout')

@section('body')

	{{-- full-width layout that starts with a container --}}
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
                @include('layouts.partials.flash')

				@yield('content')
			</div>
		</div>
	</div>

@stop
