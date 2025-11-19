@extends('layouts.main')

@section('title')

@section('content')



    <h2 style="background-color: rgb(32, 32, 40);" class="p-2 mb-2 text-center">
        Клиенты</h2>

    <a href="#" class="mt-5 text-center">
        <button type="submit" class="btn  btn-success container-fluid">
            Новый клиент
        </button>
    </a>
    <div style="overflow: auto;">
        <table class="table mt-2 rounded alert-info">
            <thead class="alert-info">
                <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Почта</th>
                    <th>Встречи</th>
                    <th>доп. ФИО</th>
                    <th>доп. почта</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->email }}</td>
                        <td>
                            @php
                                $filterUrl = route('meetings.index', [
                                    'filter' => [
                                        'client_phone' => $client->phone,
                                    ],
                                ]);
                            @endphp
                            @if (($client->meetings ?? collect())->count())
                                @php
                                    $hasActiveMeetings = $client->meetings->contains(function ($meeting) {
                                        return !$meeting->status->isFinished();
                                    });

                                    $buttonClass = $hasActiveMeetings ? 'btn-info' : 'btn-secondary';
                                @endphp
                                <a href="{{ $filterUrl }}">
                                    <button class="btn {{ $buttonClass }} btn-sm" style="min-width: 50px;">
                                        {{ $client->meetings->count() }}
                                    </button>
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($client->name_addition)
                                {{ $client->name_addition }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($client->email_addition)
                                {{ $client->email_addition }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="#">
                                <button class="btn btn-warning">
                                    Редактировать
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $clients->links('pagination::bootstrap-5') }} <!-- Пагинация -->
@endsection
