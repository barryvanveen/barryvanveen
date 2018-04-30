@include('form.partials.errors', ['title' => trans('page-admin.errors-title')])

<div class="row">
    <div class="col-md-6">
        <div class="form-group @if($errors->has('title')) has-error @endif">
            {!! Form::label('title', trans('page-admin.title'), ['class' => 'control-label form__label']) !!}
            {!! Form::text('title', $page->title, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="form-group @if($errors->has('online')) has-error @endif">
    {!! Form::label('online', trans('page-admin.status'), ['class' => 'control-label form__label']) !!}

    <div class="radio">
        <label>
            {!! Form::radio('online', '0', ($page->online == 0)) !!}
            {{ trans('general.offline') }}
        </label>
    </div>
    <div class="radio">
        <label>
            {!! Form::radio('online', '1', ($page->online == 1)) !!}
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
        <div class="form-group @if($errors->has('text')) has-error @endif">
            {!! Form::label('text', trans('page-admin.text'), ['class' => 'control-label form__label']) !!}
            {!! Form::textarea('text', $page->text, ['class' => 'form-control js-markdown-editor', 'data-markdown-route' => route('admin.markdown-to-html')]) !!}
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
