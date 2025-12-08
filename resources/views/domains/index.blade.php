@extends('layouts.main')

@section('title')

@section('content')

    <a href="{{ route('domains.create') }}" class="mt-5 text-center">
        <button type="submit" class="btn  btn-success container-fluid">
            Добавить новый
        </button>
    </a>


    <br>
    <div style="overflow: auto;">
        <table class="table mt-2 alert-info rounded">
            <thead>
                <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                    <th>url-адрес</th>
                    <th>Примечание</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($domains as $item)
                    <tr style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                        <td><a href="{{ $item->domain_url }}" target="_blank">{{ $item->domain_url }}</a></td>
                        <td>{{ $item->note }}</td>

                        <td>
                            <form action="{{ route('domains.destroy', $item) }}" method="post"
                                style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"
                                    onclick="return confirm('Удалить {{ $item->domain_url }}?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    {{ $domains->links('pagination::bootstrap-5') }} <!-- Пагинация -->




@endsection
