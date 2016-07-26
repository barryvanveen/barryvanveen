@extends('layouts.full-width')

@section('content')

    <div class="page-header">
        <h1 class="overview-heading">{{ trans('comments-admin.header-edit') }}</h1>
    </div>

    <div class="page__content">
        {!! Form::open(['route' => ['admin.comments-update', $comment->id], 'method' => 'PATCH']) !!}

        @include('comments.admin.partials.form-fields')

        {!! Form::submit(trans('general.edit'), ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>

@stop
