<article class="blog-preview" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
    <header class="blog-preview__heading">
        <h1 class="blog-preview__heading-title" itemprop="headline">
            <a href="{{$blog->url}}" class="blog-preview__heading-title-link">{{$blog->title}}</a>
        </h1>
        <p class="blog-preview__meta" title="{{$blog->publication_date_formatted}}">
            <time itemprop="datePublished" content="{{$blog->publication_date_formatted_rfc3339}}">
                {{$blog->publication_date_for_humans}}
            </time>
        </p>
    </header>
    <div itemprop="description">
        {!! $blog->html_summary !!}
    </div>
    <footer>
        <a href="{{$blog->url}}" class="blog-preview__button" itemprop="url">{{ trans('general.read-more') }}</a>
    </footer>
</article>
