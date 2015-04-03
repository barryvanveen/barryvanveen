@extends('layouts.full-width-centered')

@section('content')

    <div class="page-header">
        <h1>{{$page->title}}</h1>
    </div>

    {{$page->htmlText}}

    <p class="blog-item__heading-meta" title="{{$page->updated_at_formatted}}">
        Laatste aanpassing: {{$page->updated_at_for_humans}}
    </p>

@stop
