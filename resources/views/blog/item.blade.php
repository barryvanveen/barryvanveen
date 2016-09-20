@extends('layouts.full-width-centered')

@section('content')

    <main>
        <article class="blog-item" itemprop="mainEntity" itemscope itemtype="https://schema.org/BlogPosting">
            <header class="blog-item__heading">
                <h1 itemprop="headline">{{$blog->title}}</h1>
                <p class="blog-item__heading-meta">
                    <time itemprop="datePublished"
                          datetime="{{$blog->publication_date_formatted_rfc3339}}"
                          title="{{$blog->publication_date_formatted}}">{{$blog->publication_date_for_humans}}</time>,
                    {{ trans_choice('comments.number-of-comments',
                                   $blog->comments->count(),
                                   ['count' => $blog->comments->count()]) }},
                    <span itemprop="author">{{ trans('general.author') }}</span>
                </p>
            </header>

            <div class="blog-item__content" itemprop="articleBody">
                {!! $blog->html_text !!}
            </div>

            <section class="blog-item__comments">
                <a name="comments"></a>
                <h2>{{ trans('comments.title') }}</h2>
                <span class="blog-item__comments-count" itemprop="commentCount">{{ $blog->comments->count() }}</span>
                @each('comments.item', $blog->comments, 'comment', 'comments.no-items')
                @if (config('custom.comments_enabled'))
                    @include('comments.create')
                @else
                    @include('comments.comments-closed')
                @endif
            </section>
        </article>
    </main>
@stop