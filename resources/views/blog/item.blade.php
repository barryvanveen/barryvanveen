@extends('layouts.full-width-centered')

@section('content')

    <div class="page-header">
        <h1>{{$blog->title}}</h1>
    </div>

    <div class="blog-item">
        {{$blog->text}}
    </div>

@stop
