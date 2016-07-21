@include('form.partials.errors', ['title' => trans('comments-admin.errors-title')])

<div class="row">
    <div class="col-md-6">
        <div class="form-group @if($errors->has('email')) has-error @endif">
            {!! Form::label('email', trans('comments-admin.email'), ['class' => 'control-label form__label']) !!}
            {!! Form::text('email', $comment->email, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group @if($errors->has('name')) has-error @endif">
            {!! Form::label('name', trans('comments-admin.name'), ['class' => 'control-label form__label']) !!}
            {!! Form::text('name', $comment->name, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group @if($errors->has('ip')) has-error @endif">
            {!! Form::label('ip', trans('comments-admin.ip'), ['class' => 'control-label form__label']) !!}
            {!! Form::text('ip', $comment->ip, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group @if($errors->has('text')) has-error @endif">
            {!! Form::label('text', trans('comments-admin.text'), ['class' => 'control-label form__label']) !!}
            {!! Form::textarea('text', $comment->text, ['class' => 'form-control js-markdown-editor']) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="js-markdown-preview form__preview" data-markdown-editor-name="text"></div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <hr>
    </div>
</div>
