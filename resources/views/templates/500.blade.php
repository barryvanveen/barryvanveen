@extends('layouts.full-width-centered')

@section('content')

    <div class="page__content">
        <div class="page-header">
            <h1>Oeps!</h1>
        </div>

        <p>Sorry, er lijkt iets heel erg mis te gaan. Je ziet deze pagina omdat er een onbekende fout is opgetreden.
            Deze foutmelding wordt opgeslagen en ik ga uitzoeken hoe we dit in de toekomst kunnen voorkomen.</p>

        <p>Als je me wilt helpen kun je me <a href="mailto:barryvanveen@gmail.com">een mailtje sturen</a> en uitleggen
            hoe je deze foutmelding te zien kreeg. Dan kan ik je ook laten weten wat er fout ging en wanneer het is
            opgelost.</p>

        <p><a href="{{ route('home') }}">Ga naar de homepage</a>.</p>
    </div>

@stop
