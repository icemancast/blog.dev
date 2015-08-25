@extends('layouts.master')

@section('content')
    <h1>Please Log In</h1>

    {{ Form::open(array('action' => 'HomeController@doLogin')) }}
        <div class="form-group">
            {{ Form::label('email', 'eMail Address') }}
            {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Log In</button>
        </div>
    {{ Form::close() }}
@stop
