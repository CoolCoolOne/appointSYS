@extends('layouts.main')

@section('title')

@section('content')

    @php
        use Carbon\Carbon;
        $currentFilters = request()->query('filter', []);
        $currentSort = request()->query('sort', '');

        use App\Enums\MeetingStatus;
        $currentFilters = request()->query('filter', []);
        $filteredDayValue = isset($currentFilters['day']) ? $currentFilters['day'] : Carbon::today()->format('Y-m-d');
        $currentStatusFilter = $currentFilters['status'] ?? '';

    @endphp

    <h2 style="background-color: rgb(32, 32, 40);" class="p-2 mb-2 text-center">Встречи</h2>

    <form method="GET" action="{{ route('meetings.index') }}" class="mb-2 p-3" style="background-color: rgb(32, 32, 40);">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="filter[unit_name]" class="form-label">Фильтр по юниту</label>
                <input type="text" name="filter[unit_name]" class="form-control"
                    value="{{ $currentFilters['unit_name'] ?? '' }}" placeholder="Название юнита">
            </div>
            <div class="col-md-3">
                <label for="filter[day]" class="form-label">Фильтр по Дате</label>
                <input type="date" name="filter[day]" class="form-control" value="{{ $currentFilters['day'] ?? '' }}">
            </div>
            <div class="col-md-3">
                <label for="filter[status]" class="form-label">Фильтр по статусу</label>

                <select name="filter[status]" id="filter[status]" class="form-select">
                    <option value="">Все статусы</option>

                    @foreach (MeetingStatus::cases() as $status)
                        <option value="{{ $status->value }}"
                            {{ $currentStatusFilter === $status->value ? 'selected' : '' }}>
                            {{ $status->label() }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="filter[client_phone]" class="form-label">Фильтр по клиенту</label>
                <input type="text" name="filter[client_phone]" class="form-control"
                    value="{{ $currentFilters['client_phone'] ?? '' }}" placeholder="Телефон клиента">
            </div>
        </div>
        <div class="mt-3 d-flex justify-content-md-between">
            <button type="submit" class="btn btn-success">Применить фильтр</button>
            <div><a href="{{ route('meetings.index') }}" class="btn btn-danger">Сбросить фильтры</a></div>

        </div>
    </form>

    <div style="overflow: auto;">
        <table class="table mt-2 rounded alert-info">
            <thead class="alert-info">
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
                    <tr class="{{ $meeting->status->bootstrapClass() }}"
                        style="border-color: rgb(131, 31, 31); border-style: solid; border-width: 4px;">
                        <td>
                            <a style="color: black; text-decoration: none "
                                href="{{ route('slots.index', [$meeting->slot->unit->departament_id, $meeting->slot->unit->id]) }}">
                                {{ $meeting->slot->unit->name }}
                            </a>
                        </td>
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
                        <td> {{ $meeting->status->label() }}</td>
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

    {{ $meetings->links('pagination::bootstrap-5') }} <!-- Пагинация -->
@endsection
