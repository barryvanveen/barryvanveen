@extends('layouts.full-width')

@section('content')

    <div class="page-header">
        <h1 class="overview-heading">{{ trans('laravel-log-viewer.title') }}</h1>
    </div>

    {!! Form::open(['route' => 'admin.logs', 'method' => 'get', 'class' => 'form-horizontal']) !!}
        <legend>{{ trans('logs-admin.switch-logfile') }}</legend>
        <div class="form-group">
            <div class="col-xs-12 col-sm-10">
                {{ Form::select('l', $files, $current_file, ['class' => 'form-control']) }}
            </div>
            <div class="col-xs-12 col-sm-2 ">
                {!! Form::submit(trans('logs-admin.change'), ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    <div class="bs-component">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>{{ trans('laravel-log-viewer.level') }}</th>
                <th>{{ trans('laravel-log-viewer.date') }}</th>
                <th>{{ trans('laravel-log-viewer.content') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $key => $log)
                <tr class="js-clickable-log-row">
                    <td class="text-{{{$log['level_class']}}}">{{$log['level']}}</td>
                    <td class="date">{{{$log['date']}}}</td>
                    <td class="text">
                        @if ($log['stack'])
                            <button type="button" class="pull-right btn btn-sm btn-{{{$log['level_class']}}}"
                                    data-toggle="modal"
                                    data-target="#logModal" data-level="{{{$log['level']}}}"
                                    data-text="{{{$log['text']}}}"
                                    data-file="{{{$log['in_file']}}}" data-stack="{{{$log['stack']}}}">
                                {{ trans('laravel-log-viewer.show-stack') }}
                            </button>
                        @endif
                        {{{$log['text']}}}
                        @if (isset($log['in_file']))
                            <br />{{{$log['in_file']}}}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="logModal" tabindex="-1" role="dialog" aria-labelledby="logModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body" style="white-space: pre; overflow-x: scroll"></div>
            </div>
        </div>
    </div>

@stop
