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

<body class="bg-dark text-light custom_main_bg">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">AppointmentSYS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Описание</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">API доки</a>
                    </li>

                    @auth

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('userlist') }}">Пользователи</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Разлогиниться</a>
                        </li>



                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Авторизация</a>
                        </li>
                    @endguest

                </ul>
                @auth
                    <div class="text-decoration-none navbar-text bg-success rounded rounded-3 opacity-25"
                        style="background-color: #198754 !important">
                        <div class="nav-link text-dark bg-success rounded rounded-3">
                            <div><b>{{ auth()->user()->name }}</b>
                            </div>


                            </a>
                        @endauth
                    </div>
                </div>
    </nav>







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
