@extends('emails.template')

@section('body')
    <p>{{ trans('email.a-new-comment-was-posted', ['url' => $url]) }}</p>

    <p><a href="{{ $admin_url }}">{{ $admin_url }}</a></p>

    <hr>

    <p style="font-family: 'Lucida Console', Monaco, monospace">
        {{ $comment->id }}<br>
        {{ $comment->name }}<br>
        {{ $comment->email }}<br>
        {{ $comment->ip }}<br>
        {{ $comment->fingerprint }}<br>
        {{ $comment->created_at }}<br>
        {{ nl2br($comment->text) }}<br>
    </p>
@stop
