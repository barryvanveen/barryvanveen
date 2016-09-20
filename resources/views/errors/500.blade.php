@extends('layouts.full-width-centered')

@section('content')

    <article class="page__content">
        <header class="page-header">
            <h1>{{ trans('errors.500-title') }}</h1>
        </header>

        {!! trans('errors.500-text') !!}

        <p><a href="{{ route('home') }}">{{ trans('errors.return-to-the-homepage') }}</a>.</p>
    </article>

@stop
