@extends('layouts.full-width-centered')

@section('content')

    <section class="previewContainer" itemscope itemtype="https://schema.org/Blog">
        <div class="page-header">
            <h1>Alle artikelen</h1>
            <p class="lead" itemprop="about">een blog over Laravel en webdevelopment</p>
        </div>

        @foreach($blogs as $blog)
            @include('blog.partials.preview')
        @endforeach
    </section>

@stop
