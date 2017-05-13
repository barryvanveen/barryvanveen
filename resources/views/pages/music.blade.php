@extends('layouts.full-width-centered')

@section('content')

    <main>
        <article class="page__content" itemprop="mainEntity">
            <header class="page-header">
                <h1 itemprop="name">{{ trans('music.page-title') }}</h1>
            </header>

            <div itemprop="text">
                <p>{!! trans('music.page-intro') !!}</p>

                <h2>{{ trans('music.title-user') }}</h2>
                <div class="media">
                    <div class="media-left">
                        <a href="{{ $user['url'] }}" target="_blank">
                            <img class="media-object" src="{{ lastfmMediumThumb($user) }}"
                                 alt="{{ trans('music.alt-user-avatar', ['user' => $user['name']]) }}">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="{{ $user['url'] }}" target="_blank" class="music__link">{{ $user['name'] }}</a>
                        </h4>
                        <p>{{ trans('music.scrobbled-since', ['scrobbled' => number_format($user['playcount'], 0, ',', '.')]) }}</p>
                    </div>
                </div>

                <h2>{{ trans('music.title-now-listening') }}</h2>
                @if ($nowListening !== false)
                    <div class="media">
                        <div class="media-left">
                            @notempty(lastfmMediumThumb($nowListening))
                                <a href="{{ $nowListening['url'] }}" target="_blank">
                                    <img class="media-object" src="{{ lastfmMediumThumb($nowListening) }}"
                                         alt="{{ trans('music.alt-track-cover', ['track' => $nowListening['name'], 'artist' => $nowListening['artist']['#text']]) }}">
                                </a>
                            @endnotempty
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{ $nowListening['url'] }}" target="_blank" class="music__link">{{ $nowListening['name'] }}, {{ $nowListening['artist']['#text'] }}</a>
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
                            @notempty(lastfmMediumThumb($artist))
                                <a href="{{ $artist['url'] }}" target="_blank">
                                    <img class="media-object" src="{{ lastfmMediumThumb($artist) }}"
                                         alt="{{ trans('music.alt-artist', ['artist' => $artist['name']]) }}">
                                </a>
                            @endnotempty
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{ $artist['url'] }}" target="_blank" class="music__link">{{ $artist['name'] }}</a>
                            </h4>
                        </div>
                    </div>
                @endforeach

                <h2>{{ trans('music.title-albums') }}</h2>
                @foreach($albums as $album)
                    <div class="media">
                        <div class="media-left">
                            @notempty(lastfmMediumThumb($album))
                                <a href="{{ $album['url'] }}" target="_blank">
                                    <img class="media-object" src="{{ lastfmMediumThumb($album) }}"
                                         alt="{{ trans('music.alt-album', ['album' => $album['name'], 'artist' => $album['artist']['name']]) }}">
                                </a>
                            @endnotempty
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{ $album['url'] }}" target="_blank" class="music__link">{{ $album['name'] }} - {{ $album['artist']['name'] }}</a>
                            </h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </article>
    </main>

@stop
