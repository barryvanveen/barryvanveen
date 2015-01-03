@extends('layouts.two-columns-unequal')

@section('left-column')

    <div class="page-header">
        <h1>Laatste updates</h1>
    </div>

    <div class="blog-preview">
        <div class="blog-preview__heading">
            <h2><a href="{{ route('blog-item', ['blog' => 'blog-titel']) }}" class="pull-left">Een jaartje met minder</a></h2>
            <span class="blog-preview__heading-label label label-default pull-left">Laatste blog</span>
        </div>
        <p class="text-muted">1 dag geleden geplaatst</p>
        <p>Ja, ook ik krijg een vieze smaak in mijn mond bij de term "goede voornemens". Toch ga ik er dit jaar wel aan doen. Geïnspireerd door <a href="http://zenhabits.net/">Leo Babouta</a>'s <a href="http://zenhabits.net/without/">Year of Living Without</a> ga ik ook proberen om mijn gewoonten wat aan te passen. Om te beginnen: januari en februari geen alcohol en koffie.</p>
        <a href="{{ route('blog-item', ['blog' => 'blog-titel']) }}" class="btn btn-primary btn-sm pull-right">Lees verder</a>
    </div>

    <div class="project-preview">
        <div class="project-preview__heading">
            <h2><a href="{{ route('project-item', ['project' => 'project-titel']) }}" class="pull-left">Conway's Game of Life</a></h2>
            <span class="project-preview__heading-label label label-default pull-left">Nieuwste project</span>
        </div>
        <p class="text-muted">3 weken geleden geplaatst</p>
        <p>De <em>Game Of Life</em> is eigenlijk geen spel dat je kunt spelen, maar fascinerend is het wel. Ik heb het spel gemaakt met JavaScript en het HTML5 canvas-element.</p>
        <a href="{{ route('project-item', ['project' => 'project-titel']) }}" class="btn btn-primary btn-sm pull-right">Bekijk dit project</a>
    </div>

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
