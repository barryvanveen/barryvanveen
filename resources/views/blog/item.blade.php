@extends('layouts.full-width-centered')

@section('content')

    <main>
        <article class="blog-item">
            <header class="blog-item__heading">
                <h1>{{$blog->title}}</h1>
                <p class="blog-item__heading-meta" title="{{$blog->publication_date_formatted}}">{{$blog->publication_date_for_humans}}</p>
            </header>

            <div class="blog-item__content">
                {!! $blog->html_text !!}
            </div>
        </article>
    </main>

@stop
