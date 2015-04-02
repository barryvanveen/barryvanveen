@extends('layouts.full-width')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="overview-heading">Blog</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.blog-new') }}" class="btn btn-default btn-lg">Toevoegen</a>
            </div>
        </div>
    </div>

    <div class="bs-component">
        <table class="table table-striped table-hover overview-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Publication date</th>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr class="js-clickable-row overview-table__row @if ($blog->online) overview-table__row--online @else overview-table__row--offline @endif" data-href="{{$blog->admin_edit_url}}">
                        <td>{{$blog->id}}</td>
                        <td>{{$blog->publicationDateFormatted}}</td>
                        <td>{{$blog->title}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop
