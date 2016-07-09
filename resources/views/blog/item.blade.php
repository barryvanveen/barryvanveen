@extends('layouts.full-width-centered')

@section('content')

    <main>
        <article class="blog-item" itemscope itemtype="https://schema.org/BlogPosting">
            <header class="blog-item__heading">
                <h1 itemprop="headline">{{$blog->title}}</h1>
                <p class="blog-item__heading-meta">
                    <time itemprop="datePublished"
                          datetime="{{$blog->publication_date_formatted_rfc3339}}"
                          title="{{$blog->publication_date_formatted}}">{{$blog->publication_date_for_humans}}</time>,
                    {{trans_choice('comments.number-of-comments', $blog->comments->count(), ['count' => $blog->comments->count()])}}
                </p>
            </header>

            <div class="blog-item__content" itemprop="articleBody">
                {!! $blog->html_text !!}
            </div>
        </article>
    </main>

    <section>
        <a name="comments"></a>
        <h2>{{ trans('comments.title') }}</h2>
        @each('comments.item', $blog->comments, 'comment', 'comments.no-items')
        @include('comments.create')
    </section>
@stop