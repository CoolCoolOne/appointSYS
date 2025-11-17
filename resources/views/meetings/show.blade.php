@extends('layouts.main')

@section('title')

@section('content')

    @php
        use Carbon\Carbon;
        $slot_datetime = Carbon::parse($meeting->booked_datetime);
        $slot_date = $slot_datetime->format('d.m.Y');
        $slot_time = $slot_datetime->format('H:i');
    @endphp

    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h4 style="background-color: rgb(32, 32, 40);" class="mb-5 p-2">Запланирована встреча:<br>
                <hr>
                <span>
                    Юнит: {{ $meeting->slot->unit->name }}<br>
                    Дата: {{ $slot_date }}<br>
                    Время: {{ $slot_time }}
                </span>
                <hr>
                <span>
                    Клиент: {{ $meeting->client->name }}<br>
                    Телефон: {{ $meeting->client->phone }}<br>
                    Почта: {{ $meeting->client->email }}<br>
                    @if ($meeting->client->name_addition)
                        {
                        ФИО (дубль): {{ $meeting->client->name_addition }}
                        }<br>
                    @endif
                    @if ($meeting->client->email_addition)
                        {
                        ФИО (дубль): {{ $meeting->client->email_addition }}
                        }
                    @endif
                </span>
                <hr>
                <span>
                    Статус встречи: {{$meeting->status}}
                </span>
            </h4>



        </div>
    </div>
@endsection
