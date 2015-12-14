@extends('layouts.full-width-centered')

@section('content')

    <article class="page__content">
        <header class="page-header">
            <h1>{{ trans('errors.404-title') }}</h1>
        </header>

        {!! trans('errors.404-text') !!}

        <p><a href="{{ route('home') }}">{{ trans('errors.return-to-the-homepage') }}</a>.</p>
    </article>

@stop
