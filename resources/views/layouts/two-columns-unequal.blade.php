@extends('layout')

@section('body')

    {{-- full width column for displaying flash mesage --}}
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                @include('layouts.partials.flash')
            </div>
        </div>
    </div>

	{{-- two-columns of equal width --}}
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8">
				@yield('left-column')
			</div>
			<div class="col-xs-12 col-md-4">
				@yield('right-column')
			</div>
		</div>
	</div>

@stop
