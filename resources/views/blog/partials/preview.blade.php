<div class="blog-preview">
    <div class="blog-preview__heading">
        <h2 class="blog-preview__heading-title">
            <a href="{{$blog->url}}" class="blog-preview__heading-title-link">{{$blog->title}}</a>
        </h2>
        <span class="blog-preview__heading-label">Laatste blog</span>
    </div>
    <p>
        <span class="blog-preview__meta-label">Laatste blog</span> <span class="blog-preview__meta">{{$blog->publication_date_formatted}}</span>
    </p>
    <p>Ja, ook ik krijg een vieze smaak in mijn mond bij de term "goede voornemens". Toch ga ik er dit jaar wel aan doen. Geïnspireerd door <a href="http://zenhabits.net/">Leo Babouta</a>'s <a href="http://zenhabits.net/without/">Year of Living Without</a> ga ik ook proberen om mijn gewoonten wat aan te passen. Om te beginnen: januari en februari geen alcohol en koffie.</p>
    <a href="{{$blog->url}}" class="blog-preview__button">Lees verder</a>
</div>
