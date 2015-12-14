{!! Form::open(['route' => 'admin.login']) !!}

    @include('form.partials.errors', ['title' => trans('login.errors-title')])

    <div class="form-group @if($errors->has('email')) has-error @endif">
        {!! Form::label('email', trans('login.title-email'), ['class' => 'control-label form__label']) !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('login.placeholder-email')]) !!}
    </div>

    <div class="form-group @if ($errors->has('password')) has-error @endif">
        {!! Form::label('password', trans('login.title-password'), ['class' => 'control-label form__label']) !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('login.placeholder-password')]) !!}
    </div>

    {!! Form::submit(trans('login.button'), ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}
