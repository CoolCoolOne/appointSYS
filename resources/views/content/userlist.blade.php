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
                </tr>
            </thead>
            <tbody>
                @foreach ($users->reverse() as $user)
                    <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @if ($user->email_verified_at !== null)
                            <td>Да</td>
                        @else
                            <td>
                                <form action="{{ route('verify_manualy', $user) }}" method="post" style="display:inline-block">
                                    @csrf
                                    <button class="btn btn-success"
                                        onclick="return confirm('Верифицировать {{ $user->name }}?')">Верифицировать</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('users.destroy', $user) }}" method="post"
                                    style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"
                                        onclick="return confirm('Удалить {{ $user->name }}?')">Удалить</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links('pagination::bootstrap-5') }}


@endsection
