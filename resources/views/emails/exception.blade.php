@extends('emails.template')

@section('body')
    <p>{{ trans('email.an-exception-occured') }}</p>

    <hr>

    <p style="font-family: 'Lucida Console', Monaco, monospace">
        environment: {{ $environment }}<br><br>

        {{ $exception }}<br>
        {{ $exception_message }}<br>
        code {{ $exception_code }}<br>

        {{ $exception_file }} on line {{ $exception_line }}<br><br>

        @foreach($context as $key => $value)
            {{ $key }} {{ $value }}<br>
        @endforeach
    </p>
@stop
