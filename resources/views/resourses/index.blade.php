@extends('layouts.main')

@section('title')

@section('content')

<a href="{{ route('resourses.create') }}" class="mt-5 text-center">
                    <button type="submit" class="btn  btn-success">
                        Новый ресурс
                    </button>
                </a>


<br>
<div style="overflow: auto;">
    <table class="table mt-5 alert-info rounded">
        <thead>
            <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                <th>Название ресурса</th>
                <th>Слоты</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resourses as $item)
                <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                    <td>{{ $item->name }}</td>
                    <td>В разаработке</td>

                    <td>
                        <form action="{{ route('resourses.destroy', $item) }}" method="post" style="display:inline-block">
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


    
    {{ $resourses->links('pagination::bootstrap-5') }} <!-- Пагинация -->




@endsection
