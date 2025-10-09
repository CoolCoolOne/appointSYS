<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'AppointmentSYS')</title>
    <link href="{{ asset('./css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('./css/main.css') }}">

</head>

<body class="bg-dark text-light custom_main_bg d-flex">


    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark vh-100" style="width: 220px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <img width="25" class="me-1" src="{{ asset('images/icon.png') }}" alt="calendar">
            <span class="fs-5">AppointSYS</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link text-white" aria-current="page">
                    Описание
                </a>
            </li>
            @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link text-white" aria-current="page">
                        Авторизация
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link text-white" aria-current="page">
                        Пригласите меня
                    </a>
                </li>
            @endguest
            @auth
                <li>
                    <a href="#" class="nav-link text-white">
                        API доки
                    </a>
                </li>
                <li>
                    <a href="{{ route('departaments.index') }}" class="nav-link text-white">
                        Отделы
                    </a>
                    @include('layouts.parts.menu_onelevel')
                </li>
                <li>
                    <a href="#" class="nav-link text-white mt-2">
                        Бронирования
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="m-1 p-1 rounded" style="background-color: #198754">
                        <b>{{ auth()->user()->name }}</b>
                    </div>
                </a>
                <ul class="dropdown-menu
                        dropdown-menu-dark text-small shadow"
                    aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{ route('userlist') }}">Персонал</a></li>
                    <li><a class="dropdown-item" href="#">Приглашения</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Выйти</a></li>
                </ul>
            </div>
        @endauth
    </div>





    <main class="main mt-3">
        <div class="container">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif



            @yield('content')
        </div>
    </main>





    <script src="{{ asset('./js/bootstrap.bundle.min.js') }}"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
