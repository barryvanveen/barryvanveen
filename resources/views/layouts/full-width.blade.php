@extends('layout')

@section('body')

	{{-- full-width layout that starts with a container --}}
	<div class="container">
		@yield('content')
	</div>

@stop
