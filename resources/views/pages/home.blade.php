@extends('layouts.two-columns-unequal')

@section('left-column')

    <div class="page-header">
        <h1>Laatste updates</h1>
    </div>

    @include('blog.partials.preview')
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
        <a href="{{ route('blog-item', ['blog' => 'blog-titel']) }}" class="btn btn-primary btn-sm pull-right">Meer over mij</a>
    </div>

@stop
