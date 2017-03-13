@extends('layouts.full-width-centered')

@section('content')

    <main>
        <article class="page__content" itemprop="mainEntity">
            <header class="page-header">
                <h1 itemprop="name">{{ trans('music.page-title') }}</h1>
            </header>

            <div itemprop="text">
                <p>{!! trans('music.page-intro') !!}</p>

                <h2>{{ trans('music.title-now-listening') }}</h2>
                @if ($nowListening !== false)
                    <div class="media">
                        <div class="media-left">
                            <a href="{{ $nowListening['url'] }}" target="_blank">
                                <img class="media-object" src="{{ $nowListening['image'][1]['#text'] }}"
                                     alt="{{ trans('music.alt-track-cover', ['track' => $nowListening['name'], 'artist' => $nowListening['artist']['#text']]) }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{ $nowListening['url'] }}" target="_blank">
                                    {{ $nowListening['name'] }}, {{ $nowListening['artist']['#text'] }}
                                </a>
                            </h4>
                        </div>
                    </div>
                @else
                    <p>{{ trans('music.not-listening') }}</p>
                @endif

                <h2>{{ trans('music.title-artists') }}</h2>
                @foreach($artists as $artist)
                    <div class="media">
                        <div class="media-left">
                            <a href="{{ $artist['url'] }}" target="_blank">
                                <img class="media-object" src="{{ $artist['image'][1]['#text'] }}"
                                     alt="{{ trans('music.alt-artist', ['artist' => $artist['name']]) }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{ $artist['url'] }}" target="_blank">
                                    {{ $artist['name'] }}
                                </a>
                            </h4>
                            {{ trans('music.played-x-times', ['playcount' => $artist['playcount']]) }}
                        </div>
                    </div>
                @endforeach

                <h2>{{ trans('music.title-albums') }}</h2>
                @foreach($albums as $album)
                    <div class="media">
                        <div class="media-left">
                            <a href="{{ $album['url'] }}" target="_blank">
                                <img class="media-object" src="{{ $album['image'][1]['#text'] }}"
                                     alt="{{ trans('music.alt-album', ['album' => $album['name'], 'artist' => $album['artist']['name']]) }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{ $album['url'] }}" target="_blank">
                                    {{ $album['name'] }}, {{ $album['artist']['name'] }}
                                </a>
                            </h4>
                            {{ trans('music.played-x-times', ['playcount' => $album['playcount']]) }}
                        </div>
                    </div>
                @endforeach
            </div>
        </article>
    </main>

@stop
