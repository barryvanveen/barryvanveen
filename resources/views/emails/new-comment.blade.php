@extends('emails.template')

@section('body')
    <p>{{ trans('email.a-new-comment-was-posted', ['url' => $url]) }}</p>

    <hr>

    <p style="font-family: 'Lucida Console', Monaco, monospace">
        {{ $comment->id }}<br>
        {{ $comment->name }}<br>
        {{ $comment->email }}<br>
        {{ $comment->text }}<br>
        {{ $comment->created_at }}<br>
    </p>
@stop
