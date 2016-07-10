<div class="comment">
    <a name="add-your-comment"></a>
    <h3>{{ trans('comments.add-your-comment') }}</h3>
    {{ Form::open(['route' => ['blog-comment', $blog->id, $blog->slug], 'method' => 'POST']) }}

        @include('form.partials.errors', ['title' => trans('comments.errors-title')])

        {{-- honeypot, this should not be visible to users and so should not be filled --}}
        {{ Form::text('youshouldnotfillthisfield', '',  ['class' => 'form-control form__invisible-field']) }}

        {!! Form::label('name', trans('comments.label-name'), ['class' => 'control-label form__label']) !!}
        {{ Form::text('name', '',  ['class' => 'form-control']) }}

        {!! Form::label('email', trans('comments.label-email'), ['class' => 'control-label form__label']) !!}
        {{ Form::text('email', '',  ['class' => 'form-control']) }}

        {!! Form::label('text', trans('comments.label-text'), ['class' => 'control-label form__label']) !!}
        {{ Form::textarea('text', '', ['class' => 'form-control']) }}

        {{ Form::submit(trans('comments.submit'), ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}
</div>