@extends('layouts.full-width-centered')

@section('content')

    <div class="page__content">
        <div class="page-header">
            <h1>{{$page->title}}</h1>
        </div>

        {!! $page->html_text !!}

        @if ($page->updated_at > $page->publication_date)
            <div class="well well-sm page__last-updated">
                Laatste aanpassing: {{$page->updated_at_formatted}}
            </div>
        @endif
    </div>

@stop
