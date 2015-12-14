@extends('layouts.full-width')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="overview-heading">{{ trans('blog-admin.header-overview') }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.blog-new') }}" class="btn btn-default btn-lg">{{ trans('general.add') }}</a>
            </div>
        </div>
    </div>

    <div class="page__content bs-component">
        <table class="table table-striped table-hover overview-table">
            <thead>
                <tr>
                    <th>{{ trans('blog-admin.id-short') }}</th>
                    <th>{{ trans('blog-admin.date') }}</th>
                    <th>{{ trans('blog-admin.title') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr class="js-clickable-row overview-table__row @if ($blog->online) overview-table__row--online @else overview-table__row--offline @endif" data-href="{{$blog->admin_edit_url}}">
                        <td>{{$blog->id}}</td>
                        <td>{{$blog->publication_date_formatted}}</td>
                        <td>{{$blog->title}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop
