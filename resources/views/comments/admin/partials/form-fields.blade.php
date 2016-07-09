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
        <div class="form-group @if($errors->has('created_at')) has-error @endif">
            {!! Form::label('created_at', trans('comments-admin.date'), ['class' => 'control-label form__label']) !!}
            {!! Form::text('created_at', $comment->created_at, ['class' => 'form-control', 'placeholder' =>
            'yyyy-mm-dd hh:mm:ss']) !!}
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
