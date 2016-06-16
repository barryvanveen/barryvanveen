@extends('layouts.full-width-centered')

@section('content')

    <main>
        <article class="page__content">
            <header class="page-header">
                <h1 itemprop="name">{{$page->title}}</h1>
            </header>

            <div itemprop="text">
                {!! $page->html_text !!}
            </div>

            @if ($page->updated_at > $page->publication_date)
                <footer class="well well-sm page__last-updated">
                    {{ trans('general.last-update') }}
                    <time itemprop="lastReviewed" datetime="{{$page->updated_at_formatted_rfc3339}}">
                        {{$page->updated_at_formatted}}
                    </time>
                </footer>
            @endif
        </article>
    </main>

@stop
