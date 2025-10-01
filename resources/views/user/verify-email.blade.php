@extends('layouts.main')

@section('title')

@section('content')
    <div class="alert alert-info" role="alert">

        Спасиб за регистрацию! Чтобы завершить регистрацию пройдите по ссылке, которая придёт на вашу почту

    </div>
    <div>
        Вы не получили письмо? Тогда...
         <form method="post" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn  btn-light">Отправить мне ещё раз</button>

        </form>

    </div>
@endsection
