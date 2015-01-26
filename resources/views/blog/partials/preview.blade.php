<div class="blog-preview">
    <div class="blog-preview__heading">
        <h2 class="blog-preview__heading-title">
            <a href="{{$blog->url}}" class="blog-preview__heading-title-link">{{$blog->title}}</a>
        </h2>
    </div>
    <p>
        <span class="blog-preview__meta">{{$blog->publication_date_formatted}}</span>
    </p>
    <p>{{$blog->summary}}</p>
    <a href="{{$blog->url}}" class="blog-preview__button">Lees verder</a>
</div>
