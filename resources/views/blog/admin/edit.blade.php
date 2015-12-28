@extends('layouts.full-width')

@section('content')

    <div class="page-header">
        <h1 class="overview-heading">{{ trans('blog-admin.header-edit') }}</h1>
    </div>

    <div class="page__content">
        {!! Form::open(['route' => ['admin.blog-update', $blog->id], 'method' => 'PATCH']) !!}

        @include('blog.admin.partials.form-fields')

        {!! Form::submit(trans('general.edit'), ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>

@stop
