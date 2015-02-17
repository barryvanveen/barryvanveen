{{ Form::open(['route' => 'admin.login']) }}

    @include('form.partials.errors', ['title' => 'Inloggen mislukt'])

    <div class="form-group @if($errors->has('email')) has-error @endif">
        {{ Form::label('email', 'E-mailadres', ['class' => 'control-label form__label']) }}
        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Hier je e-mailadres']) }}
    </div>

    <div class="form-group @if ($errors->has('password')) has-error @endif">
        {{ Form::label('password', 'Wachtwoord', ['class' => 'control-label form__label']) }}
        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Hier je wachtwoord']) }}
    </div>

    {{ Form::submit('Inloggen', ['class' => 'btn btn-primary']); }}

{{ Form::close() }}