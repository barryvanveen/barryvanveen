<div>
    <a name="add-your-comment"></a>
    <h3>{{ trans('comments.add-your-comment') }}</h3>

    @include('form.partials.errors', ['title' => trans('comments.errors-title')])

    {{ Form::open(['route' => ['blog-comment', $blog->id, $blog->slug], 'method' => 'POST']) }}
        <div class="well bs-component">

            {{-- honeypot, this should not be visible to users and so should not be filled --}}
            {{ Form::text('youshouldnotfillthisfield', '',  ['class' => 'form-control form__invisible-field']) }}

            {{-- fingerprint, this should not be visible to users and is filled by Javascript onSubmit --}}
            {{ Form::hidden('_hash', '') }}

            <div class="form-group @if($errors->has('name')) has-error @endif">
                {!! Form::label('name', trans('comments.label-name'), ['class' => 'control-label form__label']) !!}
                {{ Form::text('name', '',  ['class' => 'form-control']) }}
            </div>

            <div class="form-group @if($errors->has('email')) has-error @endif">
                {!! Form::label('email', trans('comments.label-email'), ['class' => 'control-label form__label']) !!}
                {{ Form::text('email', '',  ['class' => 'form-control']) }}
            </div>

            <div class="form-group @if($errors->has('text')) has-error @endif">
                {!! Form::label('text', trans('comments.label-text'), ['class' => 'control-label form__label']) !!}
                {{ Form::textarea('text', '', ['class' => 'form-control']) }}
            </div>

            {{ Form::submit(trans('comments.submit'), ['class' => 'btn btn-primary js-submit-comment']) }}
        </div>
    {{ Form::close() }}
</div>