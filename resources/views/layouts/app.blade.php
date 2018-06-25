<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@if(isset($title)){{ $title }}@else Enterprise @endif</title>
    <meta name="title" content="@if(isset($title)){{ $title }}@endif">
    <meta name="description" content="@if(isset($description)){{ $description }}@endif">
    <meta name="keywords" content="@if(isset($keywords)){{ $keywords }}@endif">

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/bootstrap-theme.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/style.css")}}"/>
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>

</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">All users</a></li>
                    <li><a href="{{ url('/managers') }}">Managers</a></li>
                    <li><a href="{{ url('/employees') }}">Employees</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li><a href="{{ url('/self') }}">{{ Auth::user()->name }} <span class="caret"></span></a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    {{app('multiMenuWidget')->run()}}

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset("js/jquery-2.1.4.min.js")}}"></script>

    <!-- tinyMCE -->
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: '#editor',
            force_p_newlines : false,
            forced_root_block : false,
            remove_trailing_brs: false,
        });
    </script>
</body>
</html>
