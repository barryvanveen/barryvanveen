@extends('layouts.full-width')

@section('content')

    <div class="page-header">
        <h1 class="overview-heading">Pagina's -- aanpassen</h1>
    </div>

    {!! Form::open(['route' => ['admin.page-update', $page->id], 'method' => 'PATCH']) !!}

        @include('pages.admin.partials.form-fields')

    {!! Form::submit('Aanpassen', ['class' => 'btn btn-primary']); !!}

    {!! Form::close() !!}

@stop
