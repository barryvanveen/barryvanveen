<article class="blog-preview" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
    <header class="blog-preview__heading">
        <h2 class="blog-preview__heading-title" itemprop="headline">
            <a href="{{$blog->url}}" class="blog-preview__heading-title-link">{{$blog->title}}</a>
        </h2>
        <p class="blog-preview__meta">
            <time itemprop="datePublished"
                  datetime="{{$blog->publication_date_formatted_rfc3339}}"
                  title="{{$blog->publication_date_formatted}}">{{$blog->publication_date_for_humans}}</time>,
            {{trans_choice('comments.number-of-comments', $blog->comments->count(), ['count' => $blog->comments->count()])}}
        </p>
    </header>
    <div itemprop="description">
        {!! $blog->html_summary !!}
    </div>
    <footer>
        <a href="{{$blog->url}}" class="blog-preview__button" itemprop="url">{{ trans('general.read-more') }}</a>
    </footer>
</article>
