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

        @include('layouts.partials.javascript')

        <!--[if lte IE 8]>
            <script src="{!! url($assets['dist/js/main.ie8.min.js']) !!}"></script>
        <![endif]-->

	</head>
	<body itemscope itemtype="http://schema.org/WebPage">

		@include('layouts.partials.analytics')

		@include('layouts.partials.header')

		@yield('body')

		@include('layouts.partials.footer')

        @include('layouts.partials.javascript')

        <script src="{!! url($assets['dist/js/main.min.js']) !!}"></script>

	</body>
</html>
