@extends('layouts.main')

@section('title')

@section('content')


    <h2 style="background-color: rgb(32, 32, 40);" class="p-2 mb-5 text-center">Отдел: {{ $departament_name }}</h2>
    <h2>{{ $units }}</h2>
    <a href="{{ route('units.create', $departament_id) }}" class="mt-5 text-center">
        <button type="submit" class="btn  btn-success">
            Новый юнит
        </button>
    </a>


    <br>
    <div style="overflow: auto;">
        <table class="table mt-5 alert-info rounded">
            <thead>
                <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                    <th>Название юнита</th>
                    <th>Дни активности</th>
                    <th>Время активности</th>
                    <th>Продолжителность</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $item)
                    <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->convertWeekday($item->weekday) }}</td>
                        <td>{{ $item->start_time }} - {{ $item->end_time }}</td>
                        <td>{{ $item->duration_minutes }} минут</td>
                        <td>
                            <form action="{{ route('units.destroy', [$departament_id,$item]) }}" method="post" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"
                                    onclick="return confirm('Удалить {{ $item->name }}?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    {{ $units->links('pagination::bootstrap-5') }} <!-- Пагинация -->




@endsection
