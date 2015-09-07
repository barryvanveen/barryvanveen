<!doctype html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">

        <base href="{{ url() }}/">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title>{{ Meta::meta('title') }}</title>
        {!! Meta::tag('title'); !!}
        {!! Meta::tag('description'); !!}

        {!! Meta::tagMetaProperty('site_name', 'Barry van Veen'); !!}
        {!! Meta::tagMetaProperty('url', Request::url()); !!}
        {!! Meta::tagMetaProperty('locale', 'nl_NL'); !!}

        <link href="{{ route('blog-rss') }}" rel="alternate" type="application/rss+xml" title="{{ trans('general.rss-title') }}" />
        <link rel="shortcut icon" type="image/ico" href="{{ url('favicon.ico') }}">
        <link rel="author" href="{{ url(route('over-mij')) }}">

        {!! Html::style('css/screen.css', ['media' => 'screen']) !!}
        {!! Html::style('css/print.css', ['media' => 'print']) !!}

        @include('layouts.partials.javascript')

        <!--[if lte IE 8]>
            {!! Html::script('js/main.ie8.min.js') !!}
        <![endif]-->

	</head>
	<body itemscope itemtype="http://schema.org/WebPage">

		@include('layouts.partials.analytics')

		@include('layouts.partials.header')

		@yield('body')

		@include('layouts.partials.footer')

        @include('layouts.partials.javascript')

		{!! Html::script('js/main.min.js') !!}

	</body>
</html>
