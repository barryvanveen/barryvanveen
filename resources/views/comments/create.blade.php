<div class="comment">
    <a name="add-your-comment"></a>
    <h3>{{ trans('comments.add-your-comment') }}</h3>
    {{ Form::open(['route' => ['blog-comment', $blog->id, $blog->slug], 'method' => 'POST']) }}

        @include('form.partials.errors', ['title' => trans('comments.errors-title')])

        {{ csrf_field() }}

        {!! Form::label('email', trans('comments.label-email'), ['class' => 'control-label form__label']) !!}
        {{ Form::text('email', '',  ['class' => 'form-control']) }}

        {!! Form::label('text', trans('comments.label-text'), ['class' => 'control-label form__label']) !!}
        {{ Form::textarea('text', '', ['class' => 'form-control']) }}

        {{ Form::submit(trans('comments.submit'), ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}
</div>