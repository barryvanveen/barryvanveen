@extends('layouts.full-width-centered')

@section('content')

    <main role="main">
        <article class="page__content">
            <header class="page-header">
                <h1>{{$page->title}}</h1>
            </header>

            {!! $page->html_text !!}

            @if ($page->updated_at > $page->publication_date)
                <footer class="well well-sm page__last-updated">
                    {{-- todo: <time itemprop="published" datetime="2009-08-29">two days ago</time> --}}
                    Laatste aanpassing: {{$page->updated_at_formatted}}
                </footer>
            @endif
        </article>
    </main>

@stop
