@extends('layouts.full-width')

@section('content')

    <div class="page-header">
        <h1 class="overview-heading">Blog -- toevoegen</h1>
    </div>

    <div class="page__content">
        {!! Form::open(['route' => 'admin.blog-new', 'method' => 'POST']) !!}

        @include('blog.admin.partials.form-fields')

        {!! Form::submit('Toevoegen', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>

@stop
