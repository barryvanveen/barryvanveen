{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}

<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach($items as $item)
    <url>
        <loc>{{ $item['loc']  }}</loc>
        @if($item['lastmod'])
        <lastmod>{{ $item['lastmod'] }}</lastmod>
        @endif
    </url>
    @endforeach

</urlset>