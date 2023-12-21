<!DOCTYPE html>
<html>
<head>
    <title>Laravel Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
    </style>
    @stack('scripts')
</head>
<body>
<div>
    @guest
        <ul>
            <li><a href="{{route('login')}}" class="btn btn-default">Login</a></li>
            <li><a href="{{route('register')}}" class="btn btn-default">Register</a></li>
        </ul>
    @endguest
    @auth
        <ul>
            <li><a href="{{route('home')}}" class="btn btn-default">Home</a></li>
            <li><a href="{{route('list_tasks')}}" class="btn btn-default">Tasks</a></li>
            <li><a href="{{route('logout')}}" class="btn btn-default">Logout</a></li>
        </ul>
    @endauth
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    @yield('body_content', 'This is the default content, if you see this the page does not exist')
</div>
</body>
</html>
