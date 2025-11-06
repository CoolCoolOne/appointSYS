@extends('layouts.main')

@section('title')

@section('content')


    <h2 style="background-color: rgb(32, 32, 40);" class="p-2 mb-2 text-center">Слоты юнита:</h2>
    <h2 style="background-color: rgb(32, 32, 40);" class="p-2 mb-1 text-center"> {{ $unit->name }}</h2>



    <br>
    <div style="overflow: auto;">
        <table class="table mt-2 alert-info rounded">
            <thead>
                <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                    <th>Дни активности</th>
                    <th>Время активности</th>
                    <th>Продолжителность</th>
                </tr>
            </thead>
            <tbody>

                    <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                        <td>{{ $unit->convertWeekday($unit->weekday) }}</td>
                        <td>{{ $unit->start_time }} - {{ $unit->end_time }}</td>
                        <td>{{ $unit->duration_minutes }} минут</td>
                    </tr>

            </tbody>
        </table>
    </div>
    <div style="overflow: auto;">
        <table class="table mt-2 alert-info rounded" style="display: block; height: 450px; overflow: auto;">
            <thead>
                <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                    <th>Дата и время</th>
                    <th>Статус</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($slots as $item)
                    <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                        <td>{{ $item->slot_datetime }}</td>
                        <td>{{ $item->is_occupied }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



   




@endsection
