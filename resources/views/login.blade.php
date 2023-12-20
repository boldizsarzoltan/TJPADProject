@extends('base')

@section('body_content')
<form action="/loginauth" method="POST">
    @csrf
    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif
    <label for="email">Email address</label>
    <input id="email"
           type="email"
           name="email">
    <label for="email">Password</label>
    <input id="password"
           type="password"
           name="password"
   >

    @error('email', 'login')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit" @disabled($errors->isNotEmpty())>Submit</button>
</form>
@stop
