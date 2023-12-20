@extends('base')
@section('body_content')
    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif
@stop
