@extends('layouts.main')

@section('title')

@section('content')
{{-- {{ dd($newTokenRaw) }} --}}

    <h2 style="background-color: rgb(32, 32, 40);" class="p-2 mb-2 text-center">API пока не реализовано полностью!</h2>

    @if (session('api_token'))
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Токен сгенерирован успешно!</h4>
            <p>Ваш <strong>новый</strong> токен: <code>{{ $newTokenRaw }}</code></p>
            <hr>
            <p class="mb-0"><strong>Внимание:</strong> этот токен больше не будет показан после ухода с этой страницы! <br> Старые токены удалены</p>
        </div>
    @elseif ($latestToken)
        <div class="alert alert-info">
            <p>
                Активный токен уже существует! <br>
                Токен хранится в захэшированном виде, вы можете сгенерировать новый.
            </p>
        </div>
    @else
        <div class="alert alert-warning">
            У вас пока нет активного API-токена.
        </div>
    @endif

    <form action="{{ route('generate-api-token') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success container-fluid mt-1 text-center">
            {{ $latestToken ? 'Сгенерировать API-токен (старый будет удален)' : 'Сгенерировать API-токен' }}
        </button>
    </form>


@endsection
