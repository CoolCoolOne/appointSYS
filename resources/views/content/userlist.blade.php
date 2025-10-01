@extends('layouts.main')

@section('title')

@section('content')


    <div style="overflow: auto;">
    <table class="table mt-5 alert-info rounded">
        <thead>
            <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                <th>Имя</th>
                <th>Почта</th>
                <th>Верификация</th>
                <th>Создано ресурсов</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users->reverse() as $user)
                <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->hasVerifiedEmail() }}</td>
                    <td>В разработке..</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $users->links('pagination::bootstrap-5') }}


@endsection
