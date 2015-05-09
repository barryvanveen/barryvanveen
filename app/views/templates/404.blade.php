@extends('layouts.full-width-centered')

@section('content')

    <div class="page__content">
        <div class="page-header">
            <h1>Welke pagina?</h1>
        </div>

        <p>Sorry, deze pagina kan niet worden gevonden. Als je een link hebt gevolgd vanaf een externe website dan
            kan het zijn dat deze pagina ondertussen is verwijderd of hernoemd.</p>

        <p><a href="{{ route('home') }}">Ga naar de homepage</a>.</p>
    </div>

@stop
