@extends('layouts.full-width-centered')

@section('content')

    <div class="blog-item">
        <div class="blog-item__heading">
            <h1>{{$blog->title}}</h1>
            <p class="blog-item__heading-meta" title="{{$blog->publication_date_formatted}}">{{$blog->publication_date_for_humans}}</p>
        </div>

        <div class="blog-item__content">
            {!! $blog->html_text !!}
        </div>
    </div>

@stop
