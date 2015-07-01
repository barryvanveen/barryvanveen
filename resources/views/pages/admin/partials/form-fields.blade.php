@include('form.partials.errors', ['title' => 'Fouten in het formulier'])

<div class="row">
    <div class="col-md-6">
        <div class="form-group @if($errors->has('title')) has-error @endif">
            {{ Form::label('title', 'Titel', ['class' => 'control-label form__label']) }}
            {{ Form::text('title', $page->title, ['class' => 'form-control']) }}
        </div>
    </div>
</div>

<div class="form-group @if($errors->has('online')) has-error @endif">
    {{ Form::label('online', 'Status', ['class' => 'control-label form__label']) }}

    <div class="radio">
        <label>
            {{ Form::radio('online', '0', ($page->online == 0)) }}
            Offline
        </label>
    </div>
    <div class="radio">
        <label>
            {{ Form::radio('online', '1', ($page->online == 1)) }}
            Online
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
            {{ Form::label('text', 'Tekst', ['class' => 'control-label form__label']) }}
            {{ Form::textarea('text', $page->text, ['class' => 'form-control js-markdown-editor']) }}
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
