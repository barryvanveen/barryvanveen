<!doctype html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">

        <base href="{{ url() }}/">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title>{{ Meta::meta('title') }}</title>
        {!! Meta::tag('title') !!}
        {!! Meta::tag('description') !!}

        {!! Meta::tagMetaProperty('site_name', 'Barry van Veen') !!}
        {!! Meta::tagMetaProperty('url', Request::url()) !!}
        {!! Meta::tagMetaProperty('locale', 'en_EN') !!}

        <link href="{{ route('blog-rss') }}" rel="alternate" type="application/rss+xml" title="{{ trans('general.blog-rss-title') }}" />
        <link rel="shortcut icon" type="image/ico" href="{{ url('favicon.ico') }}">
        <link rel="author" href="{{ url(route('about-me')) }}">

        <style type="text/css" media="screen">{!! $critical_css !!}</style>

        <link media="print" type="text/css" rel="stylesheet" href="{!! url($assets['dist/css/print.css']) !!}">
	</head>
	<body itemscope itemtype="http://schema.org/WebPage">

        <script type="text/javascript">
            WebFontConfig = {
                google: { families: [ 'Raleway:400,700:latin' ] }
            };
            (function() {
                var wf = document.createElement('script');
                wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                        '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
                wf.type = 'text/javascript';
                wf.async = 'true';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(wf, s);
            })();
        </script>

		@include('layouts.partials.analytics')

		@include('layouts.partials.header')

		@yield('body')

		@include('layouts.partials.footer')

        @include('layouts.partials.javascript')

        <script type="text/javascript">
            {!! $lazyload_js !!}

            var lazyloadCallback = function() {
                LazyLoad.css('{!! url($assets['dist/css/screen.css']) !!}');
                LazyLoad.js([
                    '//code.jquery.com/jquery-1.11.2.min.js',
                    '{!! url($assets['dist/js/main.js']) !!}'
                    @if($is_admin)
                        ,'{!! url($assets['dist/js/admin.js']) !!}'
                    @endif
                ]);
            };

            window.addEventListener('load', lazyloadCallback);
        </script>

        <noscript>
            <style type="text/css" media="all">@import url("https://fonts.googleapis.com/css?family=Raleway:400,700");</style>
            <link href="{!! url($assets['dist/css/screen.css']) !!}" rel="stylesheet" type="text/css" media="screen">
        </noscript>

    </body>
</html>
