@extends('layouts.two-columns-unequal')

@section('left-column')

    <div class="page-header">
        <h1>Laatste updates</h1>
    </div>

    @foreach($blogs as $blog)
        @include('blog.partials.preview', ['latest' => true])
    @endforeach

    @include('projects.partials.preview')

@stop

@section('right-column')

    <div class="page-header">
        <h1>Over mij</h1>
    </div>

    <div class="about-preview">
        <ul>
            <li>Hardloper</li>
            <li>Programmeur / Scrum Master</li>
            <li>Muziekliefhebber</li>
            <li>Lezer</li>
        </ul>
        <a href="{{ route('blog-item', ['blog' => 'blog-titel']) }}" class="about-preview__button">Meer over mij</a>
    </div>

@stop
