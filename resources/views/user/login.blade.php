@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 class="mb-5">Авторизация</h1>


            <form action="{{ route('login.auth') }}" method="post">

                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email адрес</label>
                    <input name='email' type="email" class="form-control"
                        id="email" placeholder="email">
                </div>


                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input name='password' type="password" class="form-control"
                        id="password" placeholder="пароль">
                </div>

                <div class="mb-3 form-check">
                    <input name="remember" class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">
                        Запомнить меня!
                    </label>
                </div>


                <div class="mt-5 text-center">
                    <button type="submit" class="btn  btn-light">
                        Авторизация!
                    </button>
                    <a href="{{ route('password.request')}}" class="ms-3 text-secondary">Забыли пароль?</a>
                </div>



            </form>
        </div>
    </div>
@endsection
