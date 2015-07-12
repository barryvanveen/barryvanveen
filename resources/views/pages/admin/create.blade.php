@extends('layouts.full-width')

@section('content')

    <div class="page-header">
        <h1 class="overview-heading">Pagina's -- toevoegen</h1>
    </div>

    {!! Form::open(['route' => 'admin.page-new', 'method' => 'POST']) !!}

        @include('pages.admin.partials.form-fields')

    {!! Form::submit('Toevoegen', ['class' => 'btn btn-primary']); !!}

    {!! Form::close() !!}

@stop
