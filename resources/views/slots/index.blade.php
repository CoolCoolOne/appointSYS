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

    <style>
        .scroll-block {}
.scroll-block::-webkit-scrollbar-track {border-radius: 1px; cursor: pointer;}
.scroll-block::-webkit-scrollbar {height:  18px; width: 18px; cursor: pointer;}
 .scroll-block::-webkit-scrollbar-thumb {border-radius: 10px;background: #acafa4; cursor: pointer;}

    </style>

    <div class="p-2 mb-2 text-center d-flex gap-4 scroll-block" style="background-color: rgb(32, 32, 40); overflow: auto; max-height:490px">


        @foreach ($slots as $key => $days)


            <div>
                <p class="alert alert-success fw-bold">{{ $key }}</p>
                @foreach ($slots[$key] as $day)
                    <a href="#" @class([
                        'btn', 
                        'd-block',
                        'mb-2',
                        'btn-success' => !$day['is_occupied'],
                        'btn-danger' => $day['is_occupied'],
                    ])>
                        {{ $day['slot_time'] }}
                    </a>

                @endforeach
            </div>
        @endforeach


    </div>









@endsection
