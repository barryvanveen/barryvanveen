@extends('layouts.full-width-centered')

@section('content')

    <main>
        <article class="blog-item" itemscope itemtype="https://schema.org/BlogPosting">
            <header class="blog-item__heading">
                <h1 itemprop="headline">{{$blog->title}}</h1>
                <p class="blog-item__heading-meta" title="{{$blog->publication_date_formatted}}">
                    <time itemprop="datePublished" datetime="{{$blog->publication_date_formatted_rfc3339}}">
                        {{$blog->publication_date_for_humans}}
                    </time>
                </p>
            </header>

            <div class="blog-item__content" itemprop="articleBody">
                {!! $blog->html_text !!}
            </div>
        </article>
    </main>

    <section>
        <h2>{{ trans('comments.title') }}</h2>
        @each('comments.item', $blog->comments, 'comment', 'comments.no-items')
    </section>
@stop