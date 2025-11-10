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

    <div class="p-2 mb-2 text-center d-flex gap-4" style="background-color: rgb(32, 32, 40);">


        @foreach ($slots as $key => $days)
            <div>
                <p>{{ $key }}</p>
                @foreach ($slots[$key] as $day)
                    <p>{{ $day['slot_time'] }} <span>занят:{{ $day['is_occupied'] }}</span></p>

                @endforeach
            </div>
        @endforeach


    </div>









@endsection
