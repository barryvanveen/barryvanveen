@extends('layouts.full-width')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="overview-heading">Pagina's</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.page-new') }}" class="btn btn-default btn-lg">Toevoegen</a>
            </div>
        </div>
    </div>

    <div class="page__content bs-component">
        <table class="table table-striped table-hover overview-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                    <tr class="js-clickable-row overview-table__row @if ($page->online) overview-table__row--online @else
                            overview-table__row--offline @endif" data-href="{{$page->admin_edit_url}}">
                        <td>{{$page->id}}</td>
                        <td>{{$page->title}}</td>
                        <td>{{$page->updated_at_formatted}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop
