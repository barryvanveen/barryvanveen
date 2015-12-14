@extends('layouts.full-width-centered')

@section('content')

    <section class="previewContainer" itemscope itemtype="https://schema.org/Blog">
        <div class="page-header">
            <h1>{{ trans('general.homepage-title') }}</h1>
            <p class="lead" itemprop="about">{{ trans('general.homepage-subtitle') }}</p>
        </div>

        @foreach($blogs as $blog)
            @include('blog.partials.preview')
        @endforeach

        {!! $presenter->render() !!}
    </section>

@stop
