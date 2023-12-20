@extends('base')

@section('body_content')
<form action="/loginauth" method="POST">
    <label for="email">Email address</label>
    <input id="email"
           type="email"
           class="@error('email', 'login') is-invalid @enderror">

    @error('email', 'login')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit" @disabled($errors->isNotEmpty())>Submit</button>
</form>
@stop
