@extends('layouts.full-width-centered')

@section('content')

    <section class="previewContainer">
        <div class="page-header">
            <h1>Alle artikelen</h1>
        </div>

        @foreach($blogs as $blog)
            @include('blog.partials.preview')
        @endforeach
    </section>

@stop
