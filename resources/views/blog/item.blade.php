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

@section('full-width')

    <div class="prevnext">
        @if($prev_blog)
            <a href="{{ $prev_blog->url }}" class="prevnext__prev">
                <span class="prevnext__prevIconHolder">
                    <i class="icon icon--arrowLeft prevnext__prevIcon"></i>
                </span>
                <span class="prevnext__prevLink">
                    Vorig artikel:<br>{{ $prev_blog->title }}
                </span>
            </a>
        @endif

        @if($next_blog)
            <div class="prevnext__next">
                <a href="{{ $next_blog->url }}">
                    <span class="prevnext__prevLink">
                        Volgend artikel:<br>{{ $next_blog->title }}
                    </span>
                    <span class="prevnext__nextIconHolder">
                        <i class="icon icon--arrowRight prevnext__nextIcon"></i>
                    </span>
                </a>
            </div>
        @endif
    </div>

@stop
