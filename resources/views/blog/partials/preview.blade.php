<article class="blog-preview">
    <header class="blog-preview__heading">
        <h1 class="blog-preview__heading-title">
            <a href="{{$blog->url}}" class="blog-preview__heading-title-link">{{$blog->title}}</a>
        </h1>
        <p class="blog-preview__meta" title="{{$blog->publication_date_formatted}}">
            {{$blog->publication_date_for_humans}}
        </p>
    </header>
    {!! $blog->html_summary !!}
    <footer>
        <a href="{{$blog->url}}" class="blog-preview__button">Lees verder</a>
    </footer>
</article>
