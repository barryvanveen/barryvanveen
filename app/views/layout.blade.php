<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        {{ Head::display() }}

        <base href="{{ url() }}/">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link href="{{ route('blog-rss') }}" rel="alternate" type="application/rss+xml" title="{{ trans('general.rss-title') }}" />
        <link rel="shortcut icon" type="image/ico" href="favicon.ico">

        {{ HTML::style('css/screen.css', ['media' => 'screen']) }}
        {{ HTML::style('css/print.css', ['media' => 'print']) }}

        @include('layouts.partials.javascript')

        <!--[if lte IE 8]>
            {{ HTML::script('js/main.ie8.min.js') }}
        <![endif]-->

	</head>
	<body>

		@include('layouts.partials.analytics')

		@include('layouts.partials.header')

		@yield('body')

		@include('layouts.partials.footer')

        @include('layouts.partials.javascript')

		{{ HTML::script('js/main.min.js') }}

	</body>
</html>
