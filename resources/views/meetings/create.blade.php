@extends('layouts.main')

@section('title')

@section('content')

    @php
        use Carbon\Carbon;
        $slot_datetime = Carbon::parse($slot->slot_datetime);
        $slot_date = $slot_datetime->format('d.m.Y');
        $slot_time = $slot_datetime->format('H:i');
    @endphp


    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h2 style="background-color: rgb(32, 32, 40);" class="mb-5 p-2">Создание встречи<br>
                <hr>
                <span>Юнит: {{ $slot->unit->name }}<br>
                    Дата: {{ $slot_date }}<br>
                    Время: {{ $slot_time }}</span>
            </h2>

            <form action="{{ route('meetings.store') }}" method="post" style="background-color: rgb(32, 32, 40);" class="p-2">

                @csrf

                <input type="hidden" name="unit_id" value="{{ $slot->unit_id }}">

                <input type="hidden" name="slot_id" value="{{ $slot->id }}">

                <input type="hidden" name="booked_datetime" value="{{ $slot->slot_datetime }}">

                <label for="name" class="form-label">Имя клиента</label>
                <input name='name' type="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    placeholder="ФИО" value="{{ old('name') }}">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label class="mt-3" for="phone" class="form-label">Телефон</label>
                <input name='phone' type="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                    placeholder="номер телефона" value="{{ old('phone') }}">

                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label class="mt-3" for="email" class="form-label">Email</label>
                <input name='email' type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    placeholder="Почтовый адрес" value="{{ old('email') }}">

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <hr>
                <div class="mb-3">
                    <label for="status" class="form-label">Статус</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror"
                        value="{{ old('status') }}">
                        <option class="" value="pending">
                            Ожидает подтверждения
                        </option>
                        <option selected class="" value="confirmed">
                            Подтверждена
                        </option>
                        <option value="cancelled">
                            Отменена
                        </option>
                        <option disabled value="completed">
                            Завершена
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-5 text-center">
                    <button type="submit" class="btn  btn-light">
                        Добавить
                    </button>
                </div>



            </form>
        </div>
    </div>
@endsection
