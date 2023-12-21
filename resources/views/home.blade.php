@extends('base')
@section('body_content')
    @guest
        <h1>This is the homepage, please imagine something nice!</h1
    @endguest
    @auth
        <h1>Hi {{ Auth::user()["name"] }}. This is the homepage, please imagine something nice!</h1

    @endauth
    @yield('body_content', 'This is the default content, if you see this the page does not exist')
@stop
