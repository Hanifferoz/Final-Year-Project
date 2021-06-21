<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>AIR</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <style>
        a:hover {
            text-decoration: none
        }

        .closebtn {
            position: absolute;
            top: -10px;
            right: 15px;
            font-size: 30px;
        }

        .closebtn:hover {
            color: #EBD8B6;
        }

        #closee{display:none;}

        @media only screen and (max-width: 769px)
        {#closee{display:block;}}

    </style>
</head>

<body onload="closeNav()">
    <div id="app" >
        <div id="Menu" class="overlay" style="z-index:1000000;background:#2940d3">
            <div class="overlay-content" style="position:relative;">
                <a href="javascript:void(0)" class="closebtn" id="closee" onclick="closeNav()">&times;</a>
                <ul class="nav-custom">
                    <li class="li-items">
                        <a href="/home" class="nav-link-custom row w-100"><i class="col-1 fa-md fas fa-chart-pie"></i><span class="col-10">Dashboard </span></a>
                    </li>
                    <li class="li-items">
                        <a href="/airport" class="nav-link-custom row w-100"><i class="col-1 fa-md fas fa-chart-bar "></i><span class="col-10">Airports</span></a>
                    </li>
                    <li class="li-items">
                        <a href="/fleet" class="nav-link-custom row w-100"><i class="col-1 fa-md fas fa-chart-bar "></i><span class="col-10">Fleet</span></a>
                    </li>
                    <li class="li-items">
                        <a href="/routes" class="nav-link-custom row w-100"><i class="col-1 fa-md fas fa-chart-bar "></i><span class="col-10">Routes</span></a>
                    </li>
                    <li class="li-items">
                        <a href="/schedules" class="nav-link-custom row w-100"><i class="col-1 fa-md fas fa-chart-bar "></i><span class="col-10">Schedules</span></a>
                    </li>
                    <li class="li-items">
                        <a href="/flightgroup" class="nav-link-custom row w-100"><i class="col-1 fa-md fas fa-chart-bar "></i><span class="col-10">Flight Group</span></a>
                    </li>
                    <li class="li-items">
                        <a href="/predict" class="nav-link-custom row w-100"><i class="col-1 fa-md fas fa-chart-bar "></i><span class="col-10">Predict</span></a>
                    </li>
                    <li class="li-items">
                        <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link-custom row w-100"><i class="fa-md col-1 fas fa-sign-out-alt"></i><span class="col-10" style="cursor: pointer">LogOut</span></a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-expand-md shadow-sm text-white" style="background:#2940d3 " >
                <span style="font-size:20px;cursor:pointer;margin-left:5px" onclick="openNav()"><i
                    class="fas fa-bars"></i> </span>
                    <a class="navbar-brand mx-3  text-white" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                <div class="container">


                </div>
            </nav>
                <main class="py-4 mb-2">
                    <div class="container">
                        @if (Session::has('status'))
                            <div class="alert alert-success">
                                {{ Session('status') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session('error') }}
                            </div>
                        @endif
                    </div>
                    @yield('content')
                </main>
        </div>
    </div>
    <script>
        var toggle = 0;
        function openNav() {
            toggle=!toggle
            if(toggle){
                const mediaQuery = window.matchMedia('(max-width: 650px)')
                const mediaQuery2 = window.matchMedia('(min-width: 651px) and (max-width: 769px)')
                if (mediaQuery.matches) {
                    document.getElementById("Menu").style.width = "55%";
                } else {
                    if (mediaQuery2.matches) {
                        document.getElementById("Menu").style.width = "33%";

                    } else {
                        document.getElementById("Menu").style.width = "20%";
                        document.getElementById("main").style.marginLeft = "20%";
                    }
                }
            }
            else{
                document.getElementById("Menu").style.width = "0%";
                document.getElementById("main").style.marginLeft = "0%";
            }
        }
        function closeNav() {
            document.getElementById("Menu").style.width = "0%";
            document.getElementById("main").style.marginLeft = "0%";
        }
    </script>
</body>
</html>
