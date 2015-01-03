@extends('layouts.full-width-centered')

@section('content')

    <div class="page-header">
        <h1>Blog</h1>
    </div>

    <div class="blog-preview">
        <h2><a href="{{ route('blog-item', ['blog' => 'blog-titel']) }}" class="blog-preview__titel">Een jaartje met minder</a></h2>
        <p class="text-muted">1 dag geleden geplaatst</p>
        <p>Ja, ook ik krijg een vieze smaak in mijn mond bij de term "goede voornemens". Toch ga ik er dit jaar wel aan doen. Geïnspireerd door <a href="http://zenhabits.net/">Leo Babouta</a>'s <a href="http://zenhabits.net/without/">Year of Living Without</a> ga ik ook proberen om mijn gewoonten wat aan te passen. Om te beginnen: januari en februari geen alcohol en koffie.</p>
    </div>

    <div class="blog-preview">
        <h2><a href="{{ route('blog-item', ['blog' => 'blog-titel']) }}" class="blog-preview__titel">Eindelijk begonnen met een blog</a></h2>
        <p class="text-muted">2 weken geleden geplaatst</p>
        <p>Het heeft even geduurd maar ik eindelijk begonnen met mijn eigen blog. Ik liep al ruim een jaar met het idee rond maar door uitstelgedrag en de angst dat niemand dit gaat lezen ben ik nooit begonnen. Dat is nu dus voorbij en ik heb er zin in!</p>
    </div>

@stop
