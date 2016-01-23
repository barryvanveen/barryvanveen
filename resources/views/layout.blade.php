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

        <link media="screen" type="text/css" rel="stylesheet" href="{!! url($assets['dist/css/screen.css']) !!}">
        <link media="print" type="text/css" rel="stylesheet" href="{!! url($assets['dist/css/print.css']) !!}">
	</head>
	<body itemscope itemtype="http://schema.org/WebPage">

		@include('layouts.partials.analytics')

		@include('layouts.partials.header')

		@yield('body')

		@include('layouts.partials.footer')

        @include('layouts.partials.javascript')

        <script type="text/javascript">
            {!! $lazyload_js !!}

            var lazyloadCallback = function() {
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

	</body>
</html>
