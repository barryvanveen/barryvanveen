@extends('layouts.full-width-centered')

@section('content')

    <div class="page-header">
        <h1>{{ trans('login.title') }}</h1>
    </div>

    @include('templates.admin.partials.admin-login-form')

@stop
