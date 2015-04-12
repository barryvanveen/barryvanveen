@extends('emails.template')

@section('body')
    <p>Er was een Exception op barryvanveen.nl</p>

    <p style="font-family: 'Lucida Console', Monaco, monospace">
        environment: {{ $environment }}<br><br>

        {{ $exception }}<br>
        {{ $exception_message }}<br>
        code {{ $exception_code }}<br>
        {{ $exception_file }} op regel {{ $exception_line }}
    </p>
@stop