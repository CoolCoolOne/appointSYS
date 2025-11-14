@extends('layouts.main')

@section('title')

@section('content')
    <div class="alert alert-info" role="alert">
        <h3>Чтобы завершить регистрацию и получить доступ свяжитесь с администратором!</h3>


    </div>
    {{-- <div>
        Вы не получили письмо? Тогда...
         <form method="post" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn  btn-light">Отправить мне ещё раз</button>

        </form>

    </div> --}}
@endsection
