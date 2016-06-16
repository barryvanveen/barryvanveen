@extends('layouts.full-width-centered')

@section('content')

    <section class="previewContainer" itemscope itemtype="https://schema.org/Blog">
        <div class="page-header">
            <h1 itemprop="about" class="lead">{{ trans('general.homepage-title') }}</h1>
        </div>

        @foreach($blogs as $blog)
            @include('blog.partials.preview')
        @endforeach

        {!! $presenter->render() !!}
    </section>

@stop
