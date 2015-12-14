@extends('layouts.full-width')

@section('content')

    <div class="page-header">
        <h1 class="overview-heading">{{ trans('page-admin.header-edit') }}</h1>
    </div>

    <div class="page__content">
        {!! Form::open(['route' => ['admin.page-update', $page->id], 'method' => 'PATCH']) !!}

        @include('pages.admin.partials.form-fields')

        {!! Form::submit(trans('general.edit'), ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>

@stop
