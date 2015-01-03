@extends('layouts.full-width-centered')

@section('content')

    <div class="page-header">
        <h1>Blog</h1>
    </div>

    <div class="project-preview">
        <h2><a href="{{ route('project-item', ['project' => 'project-titel']) }}" class="project-preview__titel">Conway's Game of Life</a></h2>
        <p>De <em>Game Of Life</em> is eigenlijk geen spel dat je kunt spelen, maar fascinerend is het wel. Ik heb het spel gemaakt met JavaScript en het HTML5 canvas-element.</p>
        <a href="{{ route('project-item', ['project' => 'project-titel']) }}" class="btn btn-primary">Bekijk dit project</a>
    </div>

@stop
