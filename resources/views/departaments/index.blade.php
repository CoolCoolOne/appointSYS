@extends('layouts.main')

@section('title')

@section('content')

<a href="{{ route('departaments.create') }}" class="mt-5 text-center">
                    <button type="submit" class="btn  btn-success container-fluid">
                        Новый отдел
                    </button>
                </a>


<br>
<div style="overflow: auto;">
    <table class="table mt-2 alert-info rounded">
        <thead>
            <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                <th>Название отдела</th>
                <th>Юниты (ресурсы)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departaments as $item)
                <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                    <td>{{ $item->name }}</td>
                    <td><a href="{{ route('departaments.show', $item) }}">{{$item->units->count()}}</a</td>

                    <td>
                        <form action="{{ route('departaments.destroy', $item) }}" method="post" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Удалить {{$item->name}}?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


    
    {{ $departaments->links('pagination::bootstrap-5') }} <!-- Пагинация -->




@endsection
