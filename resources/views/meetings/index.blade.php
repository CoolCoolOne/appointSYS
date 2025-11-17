@extends('layouts.main')

@section('title')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp

    <h2 style="background-color: rgb(32, 32, 40);" class="p-2 mb-2 text-center">Встречи</h2>

    <div style="overflow: auto;">
        <table class="table mt-2 alert-info rounded">
            <thead>
                <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                    <th>Юнит</th>
                    <th>Дата</th>
                    <th>Время</th>
                    <th>ФИО клиента</th>
                    <th>Телефон</th>
                    <th>Почта</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($meetings as $meeting)
                    <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                        <td>{{ $meeting->slot->unit->name }}</td>
                        @php
                            $slot_datetime = Carbon::parse($meeting->booked_datetime);
                            $slot_date = $slot_datetime->format('d.m.Y');
                            $slot_time = $slot_datetime->format('H:i');
                        @endphp
                        <td>{{ $slot_date }}</td>
                        <td>{{ $slot_time }}</td>
                        <td>{{ $meeting->client->name }}</td>
                        <td>{{ $meeting->client->phone }}</td>
                        <td>{{ $meeting->client->email }}</td>
                        <td> {{ $meeting->status }}</td>
                        <td>
                            <a href="#">
                                <button class="btn btn-warning">
                                    Редактировать
                                </button>
                            </a>
                        </td>
                        @if ($meeting->client->name_addition or $meeting->client->email_addition)
                            <td>
                                <button class="btn btn-info">
                                    доп. поля
                                </button>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
