@extends('layouts.full-width')

@section('content')

    <div class="page-header">
        <h1>Blog</h1>
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
                    <tr class="overview-table__row @if ($blog->online) overview-table__row--online @else overview-table__row--offline @endif">
                        <td>{{$blog->id}}</td>
                        <td>{{$blog->publicationDateFormatted}}</td>
                        <td>{{$blog->title}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop
