@extends('base')
@section('body_content')
    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif
    {{Form::open(array('route' => 'register_action', 'method' => 'post'))}}
    {{ Form::token() }}
    {{ Form::label('name', 'name:') }}
    {{ Form::text('name') }}
    <br>
    {{ Form::label('email', 'email:') }}
    {{ Form::text('email') }}
    <br>
    {{ Form::label('password', 'password:') }}
    {!! Form::input('password', 'password') !!}
    <br>
    {{ Form::submit('Send this form!') }}
    {{ Form::close() }}
@stop
