@include('form.partials.errors', ['title' => trans('blog-admin.errors-title')])

<div class="row">
    <div class="col-md-6">
        <div class="form-group @if($errors->has('title')) has-error @endif">
            {!! Form::label('title', trans('blog-admin.title'), ['class' => 'control-label form__label']) !!}
            {!! Form::text('title', $blog->title, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group @if($errors->has('publication_date')) has-error @endif">
            {!! Form::label('publication_date', trans('blog-admin.date'), ['class' => 'control-label form__label']) !!}
            {!! Form::text('publication_date', $blog->publication_date, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd hh:mm:ss']) !!}
        </div>
    </div>
</div>

<div class="form-group @if($errors->has('online')) has-error @endif">
    {!! Form::label('online', trans('blog-admin.status'), ['class' => 'control-label form__label']) !!}

    <div class="radio">
        <label>
            {!! Form::radio('online', '0', ($blog->online == 0)) !!}
            {{ trans('general.offline') }}
        </label>
    </div>
    <div class="radio">
        <label>
            {!! Form::radio('online', '1', ($blog->online == 1)) !!}
            {{ trans('general.online') }}
        </label>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group @if($errors->has('summary')) has-error @endif">
            {!! Form::label('summary', trans('blog-admin.summary'), ['class' => 'control-label form__label']) !!}
            {!! Form::textarea('summary', $blog->summary, ['class' => 'form-control js-markdown-editor']) !!}
            <span class="help-block">
                <span class="js-character-counter" data-character-counter-name="summary"></span>
                {{ trans('general.characters')}} ({{ trans('general.ideal-length-120-170') }})
            </span>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="js-markdown-preview form__preview" data-markdown-editor-name="summary"></div>
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
            {!! Form::label('text', trans('blog-admin.text'), ['class' => 'control-label form__label']) !!}
            {!! Form::textarea('text', $blog->text, ['class' => 'form-control js-markdown-editor']) !!}
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
