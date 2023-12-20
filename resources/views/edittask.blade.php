@extends('base')
@section('body_content')
    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif
    {{Form::open(array('route' => ['edit_task_name', $task_id], 'method' => 'post'))}}
    {{ Form::token() }}
    {{ Form::label('name', 'name:') }}
    {{ Form::text('name', $task["name"]) }}
    <br>
    {{ Form::label('description', 'description:') }}
    {{ Form::text('description', $task["description"])}}
    <br>
    {{ Form::label('start', 'start:') }}
    {!! Form::input('datetime-local', 'start', (new \DateTime($task["start"]))->add(DateInterval::createFromDateString("10 minutes"))->format('Y-m-d H:i:s')) !!}
    <br>
    {{ Form::label('end', 'end:') }}
    {!! Form::input('datetime-local', 'end', (new \DateTime($task["end"]))->add(DateInterval::createFromDateString("20 minutes"))->format('Y-m-d H:i:s')) !!}
    <br>
    {{ Form::submit('Send this form!') }}
    {{ Form::close() }}
@stop
