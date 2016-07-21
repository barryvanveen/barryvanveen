@extends('layouts.full-width')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="overview-heading">{{ trans('comments-admin.header-overview') }}</h1>
            </div>
        </div>
    </div>

    <div class="page__content bs-component">
        <table class="table table-striped table-hover overview-table">
            <thead>
                <tr>
                    <th>{{ trans('comments-admin.id-short') }}</th>
                    <th>{{ trans('comments-admin.date') }}</th>
                    <th>{{ trans('comments-admin.email') }}</th>
                    <th>{{ trans('comments-admin.name') }}</th>
                    <th>{{ trans('comments-admin.text') }}</th>
                    <th>{{ trans('comments-admin.ip') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr class="js-clickable-row overview-table__row" data-href="{{$comment->admin_edit_url}}">
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td>{{$comment->email}}</td>
                        <td>{{$comment->name}}</td>
                        <td>{{$comment->text}}</td>
                        <td>{{$comment->ip}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop
