<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f25fd8a42.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header d-flex flex-column align-items-center">
                {{-- mostra avatar solo se presente --}}
                @if (Auth::user()->avatar)
                <img src="{{asset('/storage/image/' . Auth::user()->avatar)}}" alt="avatar" width="70">
                {{-- altrimenti non mostra nulla --}}
                @endif
                <p class="mt-2">
                    <span class="icon"><i class="far fa-laugh-wink"></i></span>
                    <span class="title">
                        Ciao {{ Auth::user()->name }}
                    </span>
                </p>
            </div>
            <ul class="list-unstyled cambio-active">
            <li class="voce-menu">
                    <a href="{{ route('home') }}">
                        <span class="icon pr-2"><i class="fas fa-home"></i></span>
                        <span class="title">Visita il sito</span>
                    </a>
                </li>
                <li class="voce-menu {{Request::route()->getName() == 'admin.home' ? 'active' : ''}}">
                    <a href="{{ route('admin.home') }}">
                        <span class="icon pr-2"><i class="fas fa-user"></i></span>
                        <span class="title">Profilo</span>
                    </a>
                </li>
                <li class="voce-menu {{Request::route()->getName() == 'admin.apartments.index' ? 'active' : ''}}">
                    <a href="{{ route('admin.apartments.index') }}">
                        <span class="icon pr-2"><i class="fas fa-list"></i></span>
                        <span class="title">Appartamenti</span>
                    </a>
                </li>
                <li class="voce-menu {{Request::route()->getName() == 'admin.message' ? 'active' : ''}}">
                    <a href="{{ route('admin.message') }}">
                        <span class="icon pr-2"><i class="fas fa-envelope"></i></span>
                        <span class="title">Messaggi</span>
                    </a>
                </li>
                <li class="voce-menu">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon pr-2"><i class="fas fa-sign-out-alt"></i></span>
                        <span class="title">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <div id="content">
            <div id="toggle" class="p-4 d-md-none">
                <a id="panino" href="#">
                    <i class="fas fa-2x fa-bars"></i>
                </a>

                <div class="hamburger-menu">
                    <ul class="">
                        <li class="voce-menu">
                                <a href="{{ route('home') }}">
                                    <span class="icon pr-2"><i class="fas fa-home"></i></span>
                                    <span class="title">Visita il sito</span>
                                </a>
                            </li>
                            <li class="voce-menu {{Request::route()->getName() == 'admin.home' ? 'active' : ''}}">
                                <a href="{{ route('admin.home') }}">
                                    <span class="icon pr-2"><i class="fas fa-user"></i></span>
                                    <span class="title">Profilo</span>
                                </a>
                            </li>
                            <li class="voce-menu {{Request::route()->getName() == 'admin.apartments.index' ? 'active' : ''}}">
                                <a href="{{ route('admin.apartments.index') }}">
                                    <span class="icon pr-2"><i class="fas fa-list"></i></span>
                                    <span class="title">Appartamenti</span>
                                </a>
                            </li>
                            <li class="voce-menu {{Request::route()->getName() == 'admin.message' ? 'active' : ''}}">
                                <a href="{{ route('admin.message') }}">
                                    <span class="icon pr-2"><i class="fas fa-envelope"></i></span>
                                    <span class="title">Messaggi</span>
                                </a>
                            </li>
                            <li class="voce-menu">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="icon pr-2"><i class="fas fa-sign-out-alt"></i></span>
                                    <span class="title">Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    <a class="close">
                        <i id="close" class="fas fa-times"></i>
                    </a>

                </div>
            </div>
            @yield('content')
        </div>

    </div>
    @yield('script')

</body>
</html>
